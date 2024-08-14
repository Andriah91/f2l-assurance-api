<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'path',
        'message'
    ];

    public function createNotification($data)
    {
        return $this->create($data);
    }

    public function deleteNotification($id)
    {
        $notif = $this->findOrFail($id);
        $notif->delete();
        return $notif;
    }

    public function updateNotification($id, $data)
    {
        $notif= $this->findOrFail($id);
        $notif->update($data);
        return $notif;
    }

    public function sendNotification($message, $path, $user_id = null, $is_to_save = true)
    {

        $client = new Client();
        $oneSignalAppId = env('ONE_SIGNAL_APP_ID');
        $oneSignalAuthorize = env('ONE_SIGNAL_AUTHORIZE');

        try {
            $postData = [
                'app_id' => $oneSignalAppId,
                //'included_segments' => ['All'],
                "filters" => [
                    ["field" => "tag", "key" => "app", "relation" => "=", "value" => strtolower(getenv("APP_NAME"))]
                ],
                'contents' => [
                    'en' => $message,
                    'fr' => $message
                ]
            ];

            if(isset($user_id)){
                $postData['filters'][] = ["field" => "tag", "key" => "phone", "relation" => "=", "value" => $user_id];
            }

            if ($path != "path") {
                $linkImg = env('SERVER_API_IMG').'/'.$path;
                $postData['ios_attachments'] = array('id'. time() => $linkImg);
                $postData['big_picture'] = $linkImg;
            }

            $response = $client->post('https://api.onesignal.com/notifications', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . $oneSignalAuthorize,
                ],
                'json' => $postData
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            if ($statusCode === 200) {
                if($is_to_save)
                    $this->createNotification(
                        [
                            "title" => "Notification",
                            "message" => $message,
                            "path" => $path
                        ]
                    );
            }

            return response()->json([
                'status' => 'response',
                'code' => $statusCode,
                'body' => json_decode($body),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],500);
        }
    }
}



