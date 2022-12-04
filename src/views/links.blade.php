<ul class="easy-share">
    @foreach($services as $name => $service)
    <li class="easy-share-{{$name}} {{$service['class'] ?? ''}}">
        <a href="{{$service['url'] ?? '#'}}" target="_blank" title="{{$service['title']}}">{!! $service['content'] ?? '' !!}</a>
    </li>
    @endforeach
</ul>
