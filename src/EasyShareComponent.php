<?php


namespace VPominchuk\EasyShare;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use \VPominchuk\EasyShare\Facades\EasyShare;

class EasyShareComponent extends Component
{
    public function render()
    {
        return function (array $data) {
            $attributes = $data['attributes']->getAttributes();

            if (empty($attributes['url'])) {
                $attributes['url'] = URL::current();
            }

            $easyShare = EasyShare::setUrl($attributes['url']);

            if (!empty($attributes['title'])) {
                $easyShare->setTitle($attributes['title']);
            }

            if (!empty($attributes['summary'])) {
                $easyShare->setSummary($attributes['summary']);
            }

            if (!empty($attributes['allow'])) {
                $allowed = explode(',', $attributes['allow']);
                $easyShare->setAllowed($allowed);
            }

            if (!empty($attributes['disable'])) {
                $disabled = explode(',', $attributes['disable']);
                $easyShare->disable($disabled);
            }

            $services = $easyShare->getServices();

            $params = ['services' => $services];

            foreach ($attributes as $attributeName => $attributeValue) {
                $params[Str::camel($attributeName)] = $attributeValue;
            }

            return view('easy-share::links')
                ->with($params)
                ->render();
        };
    }
}
