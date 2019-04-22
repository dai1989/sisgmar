{{-- @foreach ((array) session('flash_notification') as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
        >

            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            @if ($message['level'] == true)
              <h4><i class="icon fa fa-info"></i> Atención!</h4>
            @else
              @if ($message['level'] == 'danger')
                  <h4><i class="icon fa fa-ban"></i> Atención!</h4>
              @endif
              @if ($message['level'] == 'success')
                  <h4><i class="icon fa fa-check"></i> Atención!</h4>
              @endif
              @if ($message['level'] == 'warning')
                <h4><i class="icon fa fa-warning"></i> Atención!</h4>
              @endif
            @endif
            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }} --}}


@foreach ((array) session('flash_notification') as $message)
@php $message = (array)$message[0]; @endphp
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif
            @if ($message['level'] == true)
              <h4><i class="icon fa fa-info"></i> Atención!</h4>
            @else
              @if ($message['level'] == 'danger')
                  <h4><i class="icon fa fa-ban"></i> Atención!</h4>
              @endif
              @if ($message['level'] == 'success')
                  <h4><i class="icon fa fa-check"></i> Atención!</h4>
              @endif
              @if ($message['level'] == 'warning')
                <h4><i class="icon fa fa-warning"></i> Atención!</h4>
              @endif
            @endif
            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
