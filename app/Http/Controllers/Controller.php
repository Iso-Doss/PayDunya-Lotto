<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected string $profile = 'customer';

    public function __construct(string $profile = 'customer')
    {
        $this->profile = $profile;
        View::share('profile', $this->profile);
    }

    /**
     * Upload image.
     *
     * @param Request $request The request.
     * @param string $path The path.
     * @return bool|string The upload image.
     */
    public function uploadImage(Request $request, string $path): bool|string
    {
        /** @var UploadedFile | null $image */
        $image = $request->validated('image');
        if (null === $image || $image->getError()) {
            return false;
        }
        return $image->store($path, 'public');
    }

    /**
     * Get the profile guard.
     *
     * @param string $profile The profile.
     * @return string $guard The guard.
     */
    public function getGuard(string $profile): string
    {
        $guard = 'customer';
        if ('ADMINISTRATOR' == $profile) {
            $guard = 'administrator';
        }

        return $guard;
    }
}
