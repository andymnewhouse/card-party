<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class Version extends Tags
{
    public function index()
    {
        $major = config('version.major');
        $minor = config('version.minor');
        $patch = config('version.patch');

        $format = $this->params->get('format') ?? 'base';
        $formats = [
            'major' => $major,
            'minor' => $minor,
            'patch' => $patch,
            'base' => "v{$major}.{$minor}.{$patch}",
        ];

        return "<a href='/changelog' class='hover:underline'>{$formats[$format]}</a>";
    }
}
