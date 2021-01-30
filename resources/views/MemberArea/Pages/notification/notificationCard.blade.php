<div id="aaa" class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
    @forelse ($notifications as $notification)
    <div class="timeline-block">
        <span class="timeline-step badge-info">
            <i class="ni ni-bell-55"></i>
        </span>
        <div class="timeline-content">
            <small
                class="text-muted font-weight-bold">{{\carbon\carbon::parse($notification->created_at)->tz('EST5EDT')->format('M-d-Y H:i a')}}</small>
            <p class=" text-sm mt-1 mb-0">{!! $notification->msg !!}</p>
        </div>
    </div>
    @empty
    <div class="row justify-content-center m-0">
        <div class="col-lg-6">
            <h4 class="text-center">
                Empty Notifications
            </h4>
        </div>
    </div>
    @endforelse
</div>
<br><br>
{{-- {{ $notifications->links() }} --}}