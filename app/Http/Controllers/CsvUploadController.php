<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;
use Omniphx\Forrest\Exceptions\SalesforceException;
use Omniphx\Forrest\Exceptions\MissingTokenException;
use App\Http\Services\Cloudcube;

class CsvUploadController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        try {
            $user = Forrest::identity();
            $user_id = $user['user_id'];
            $applications = Forrest::query('
                Select
                    Id, Name, Type, DeveloperName, IsReadonly
                 From
                    Folder
                 Where
                    Type=\'Insights\' And CreatedbyId=\''.$user_id.'\'
            ');
            return view('top', [
                'display_name' => $user['display_name'],
                'applications' => $applications['records'],
            ]);
        } catch (MissingTokenException $e) {
            return redirect('/');

        } catch (SalesforceException $e) {
            return redirect('/');
        }
    }

    /**
     *
     * ファイルアップロード処理
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function upload(Request $request)
    {
        $application_id = $request->input('app_id');
        $upload_name = $request->input('upload_name');
        $meta_json = base64_encode(json_encode([
            "fileFormat" => [
               "charsetName" => "UTF-8",
               "fieldsDelimitedBy" => ",",
               "fieldsEnclosedBy" => "\"",
               "linesTerminatedBy" => "\n"
            ],
            "objects" => [
                [
                    "connector" => "CSV",
                    "description" => "",
                    "fullyQualifiedName" => $upload_name,
                    "label" => $upload_name,
                    "name" => $upload_name,
                    "fields" => [
                        [
                            "fullyQualifiedName" => "Column1",
                            "name" => "Column1",
                            "type" => "Date",
                            "label" => "日付",
                            "format" => "yyyy-MM-dd"
                        ],
                        [
                            "fullyQualifiedName" => "Column2",
                            "name" => "Column2",
                            "type" => "Text",
                            "label" => "時刻"
                        ],
                        [
                            "fullyQualifiedName" => "Column3",
                            "name" => "Column3",
                            "type" => "Text",
                            "label" => "車番情報（地名）"
                        ],
                        [
                            "fullyQualifiedName" => "Column4",
                            "name" => "Column4",
                            "type" => "Numeric",
                            "label" => "車番情報（分類番号）",
                            "precision" => 18,
                            "defaultValue" => "0",
                            "scale" => 0,
                            "format" => "0"
                        ],
                        [
                            "fullyQualifiedName" => "Column5",
                            "name" => "Column5",
                            "type" => "Text",
                            "label" => "車番情報（用途）"
                        ],
                        [
                            "fullyQualifiedName" => "Column6",
                            "name" => "Column6",
                            "type" => "Numeric",
                            "label" => "車番情報（一連指定番号）",
                            "precision" => 18,
                            "defaultValue" => "0",
                            "scale" => 0,
                            "format" => "0"
                        ],
                        [
                            "fullyQualifiedName" => "Column7",
                            "name" => "Column7",
                            "type" => "Numeric",
                            "label" => "スコア",
                            "precision" => 18,
                            "defaultValue" => "0",
                            "scale" => 1,
                            "format" => "0.0",
                            "decimalSeparator" => "."
                        ],
                        [
                            "fullyQualifiedName" => "Column8",
                            "name" => "Column8",
                            "type" => "Numeric",
                            "label" => "プレートカラー",
                            "precision" => 18,
                            "defaultValue" => "0",
                            "scale" => 0,
                            "format" => "0"
                        ]
                    ]
                ]
            ]
        ]));
        $csv = base64_encode(file_get_contents($request->file('csv')->getPathname()));
        $insight_response = Forrest::sobjects('InsightsExternalData', [
            'method' => 'post',
            'body' => [
                'Format' => 'CSV',
                'Action' => 'None',
                'EdgemartLabel' => $upload_name,
                'EdgemartAlias' => $upload_name,
                'Operation' => 'Append',
                'MetadataJson' => $meta_json,
                'EdgemartContainer' => $application_id,
            ]
        ]);
        $external_data_id = $insight_response['id'];
        $insight_part_response = Forrest::sobjects('InsightsExternalDataPart', [
            'method' => 'post',
            'body' => [
                'InsightsExternalDataId' => $external_data_id,
                'DataFile' => $csv,
                'PartNumber' => 1
            ]
        ]);
        $insight_patch_response = Forrest::sobjects('InsightsExternalData/' . $external_data_id, [
            'method' => 'patch',
            'body' => [
                'Action' => 'Process'
            ]
        ]);
        return redirect("/uploader");
    }
}
