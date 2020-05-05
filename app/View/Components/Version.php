<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Version extends Component
{
    public $format;
    public $major;
    public $minor;
    public $patch;

    public function __construct($format = 'base')
    {
        $this->format = $format;
        $this->major = config('version.major');
        $this->minor = config('version.minor');
        $this->patch = config('version.patch');
    }

    public function render()
    {
        return view('components.version');
    }

    public function version()
    {
        $formats = [
            'major' => $this->major,
            'minor' => $this->minor,
            'patch' => $this->patch,
            'base' => "v{$this->major}.{$this->minor}.{$this->patch}",
        ];

        return Cache::remember('version', 432000, function () use ($formats) {
            return $formats[$this->format];
        });
    }
}
