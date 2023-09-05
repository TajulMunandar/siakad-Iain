@props(['id', 'modalSize', 'title', 'route', 'method', 'primaryBtnStyle', 'secBtnStyle', 'btnTitle'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog {{ $modalSize ?? '' }}" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">{{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ $route ?? '' }}" method="post" enctype="multipart/form-data">
        @method($method ?? '')
        @csrf
        <div class="modal-body">
          {{ $slot }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn {{ $secBtnStyle ?? 'btn-outline-secondary' }}" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn {{ $primaryBtnStyle ?? 'btn-primary' }}">{{ $btnTitle ?? 'Simpan' }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
