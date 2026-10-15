@extends('layouts.back-end.app')

@section('title', 'All Notifications')

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0">All Notifications</h2>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Notification</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr>
                                <td>
                                    <a href="{{ $notification->link ?: 'javascript:' }}"
                                       @if (!$notification->is_read)
                                           onclick="fetch('{{ route('admin.admin.notifications.mark-read') }}',{method:'POST',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json','Content-Type':'application/json'},body:JSON.stringify({id:{{ $notification->id }}})});"
                                       @endif>
                                        {{ $notification->title }}
                                    </a>
                                </td>
                                <td style="white-space: normal;">{{ $notification->message }}</td>
                                <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if ($notification->is_read)
                                        <span class="badge badge-soft-success">Read</span>
                                    @else
                                        <span class="badge badge-soft-warning">Unread</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    {{ \App\CPU\translate('no_notifications_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection
