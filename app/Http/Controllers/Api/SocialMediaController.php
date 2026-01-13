<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\HomeSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SocialMediaController extends ApiController
{
    private function getActiveSocialMediaConfig(): ?array
    {
        $section = HomeSection::active()->byType('social_media_feed')->ordered()->first();
        if (!$section) {
            return null;
        }
        return $section->config_data ?? [];
    }

    public function settings(): JsonResponse
    {
        try {
            $config = $this->getActiveSocialMediaConfig();
            if (!$config) {
                return $this->notFoundResponse('Social media settings not found');
            }

            $mask = function (?string $value) {
                if (!$value) return null;
                $len = strlen($value);
                return $len <= 8 ? '****' : substr($value, 0, 2) . str_repeat('*', $len - 6) . substr($value, -4);
            };

            return $this->successResponse([
                'instagram_user_id' => $config['instagram_user_id'] ?? null,
                'instagram_access_token_masked' => $mask($config['instagram_access_token'] ?? null),
                'tiktok_user_id' => $config['tiktok_user_id'] ?? null,
                'tiktok_access_token_masked' => $mask($config['tiktok_access_token'] ?? null),
                'instagram_follow_url' => $config['instagram_follow_url'] ?? null,
                'tiktok_follow_url' => $config['tiktok_follow_url'] ?? null,
                'is_configured' => !empty(($config['instagram_user_id'] ?? null)) && !empty(($config['instagram_access_token'] ?? null)),
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch social media settings', 500, $e->getMessage());
        }
    }

    // CAUTION: Exposes raw tokens. Use only server-to-server.
    public function settingsRaw(): JsonResponse
    {
        try {
            $config = $this->getActiveSocialMediaConfig();
            if (!$config) {
                return $this->notFoundResponse('Social media settings not found');
            }

            return $this->successResponse([
                'instagram_user_id' => $config['instagram_user_id'] ?? null,
                'instagram_access_token' => $config['instagram_access_token'] ?? null,
                'tiktok_user_id' => $config['tiktok_user_id'] ?? null,
                'tiktok_access_token' => $config['tiktok_access_token'] ?? null,
                'instagram_follow_url' => $config['instagram_follow_url'] ?? null,
                'tiktok_follow_url' => $config['tiktok_follow_url'] ?? null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch raw social media settings', 500, $e->getMessage());
        }
    }

    public function instagram(): JsonResponse
    {
        try {
            $config = $this->getActiveSocialMediaConfig();
            if (!$config) {
                return $this->notFoundResponse('Social media settings not found');
            }

            $userId = $config['instagram_user_id'] ?? null;
            $token = $config['instagram_access_token'] ?? null;
            if (!$userId || !$token) {
                return $this->errorResponse('Instagram credentials not configured', 400);
            }

            $url = sprintf(
                'https://graph.instagram.com/%s/media?fields=id,media_type,media_url,thumbnail_url,caption,permalink,timestamp&access_token=%s&limit=8',
                urlencode($userId),
                urlencode($token)
            );

            $response = Http::timeout(10)->get($url);
            if (!$response->ok()) {
                return $this->errorResponse('Failed to fetch Instagram posts', $response->status(), $response->body());
            }

            $data = $response->json();
            return $this->successResponse($data['data'] ?? []);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch Instagram posts', 500, $e->getMessage());
        }
    }
}


