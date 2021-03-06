<a title="Click to mark as favorite question (Click again to undo)" 
    class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}"
>
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>
<form id="favorite-question-{{ $model->id }}" action="/stock_overflow/public/{{ $firstURISegment }}/{{ $model->id }}/favorites" method="POST" style="display:none;">
    @csrf
    @if ($model->is_favorited)
        @method ('DELETE')
    @endif
</form>