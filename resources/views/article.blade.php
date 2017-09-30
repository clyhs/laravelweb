<h1 style="text-align: center; margin-top: 50px;">{{ $article->title }}</h1>
<hr>
<div id="date" style="text-align: right;">
    {{ $article->updated_at }}
</div>
<div id="content" style="margin: 20px;">
    <p>
        {{ $article->body }}
    </p>
</div>