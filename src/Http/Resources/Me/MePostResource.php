<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Me;

use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Resources\Json\JsonResource;

class MePostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray($request): array
    {
        $post = InstagramPost::query()->select('id')->where('instagram_id', $this->id)->first();
        $session = json_decode($request->getSession()->get('instagram'));

        return [
            'id' => $post?->id,
            'caption' => $this->caption,
            'instagram_id' => $this->id,
            'instagram_user_id' => $session->instagram_user_id,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'permalink' => $this->permalink,
            'username' => $this->username,
            'timestamp' => $this->timestamp,
        ];
    }
}
