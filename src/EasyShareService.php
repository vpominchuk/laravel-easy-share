<?php


namespace VPominchuk\EasyShare;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EasyShareService
{
    private string $url = '';
    private string $title = '';
    private string $summary = '';
    private array $allowed = [];

    public function __construct()
    {
        $this->allowed = collect($this->getAllServices())->map(function($service, $serviceName) {
            if ($service['allowed']) {
                return $serviceName;
            }

            return null;
        })->filter()->toArray();
    }

    public function getAllowedServices(): Collection
    {
        return collect($this->getAllServices())->filter(function($service, $serviceName) {
            return in_array($serviceName, $this->allowed);
        });
    }

    public function getAllServices(): ?array
    {
        return config('easy-share.links');
    }

    public function setUrl(string $url): EasyShareService
    {
        $this->url = $url;

        return $this;
    }

    public function setTitle(string $title): EasyShareService
    {
        $this->title = $title;

        return $this;
    }

    public function setSummary(string $summary): EasyShareService
    {
        $this->summary = $summary;

        return $this;
    }

    public function setAllowed(array $allowed): EasyShareService
    {
        $this->allowed = $allowed;
        return $this;
    }

    /**
     * @param string|array $services
     * @return $this
     */
    public function disable($services): EasyShareService
    {
        if (!is_array($services)) {
            $services = (array)$services;
        }

        $this->allowed = array_diff($this->allowed, $services);

        return $this;
    }

    public function getServices(): array
    {
        $allowedServices = $this->getAllowedServices();

        $allowedServices = $allowedServices->transform(function($service) {
            $service['url'] = str_replace('{url}', urlencode($this->url), $service['url']);
            $service['url'] = str_replace('{title}', urlencode($this->title), $service['url']);
            $service['url'] = str_replace('{summary}', urlencode($this->summary), $service['url']);

            return $service;
        });

        return $allowedServices->toArray();
    }
}
