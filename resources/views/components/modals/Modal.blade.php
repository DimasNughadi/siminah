@props(['route'])

<div class="modal fade" id="{{ $modalName }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-csm">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" action="{{ $route }}">
            {{ $slotMethod }}
                <div class="modal-header d-flex justify-content-center">
                    <h1 class="modal-title text-poppins c-fs20 c-fwb" id="exampleModalLabel">{{ $title }}</h1>
                </div>
                <div class="modal-body">
                    {{ $slotBody }}
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    {{ $slotFooter }}
                </div>
            </form>
        </div>
    </div>
</div>