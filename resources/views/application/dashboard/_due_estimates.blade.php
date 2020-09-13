@if($dueEstimates->count() > 0)
    <table class="table table-striped border-bottom mb-0">
        <tbody>
            @foreach ($dueEstimates as $estimate)
                <tr>
                    <td>
                        <div>
                            <a href="{{ route('estimates.details', $estimate->id) }}" class="text-15pt d-flex align-items-center">
                                <strong>{{ $estimate->estimate_number }}</strong>
                            </a>
                        </div>
                    </td> 
                    <td class="text-center">
                        <a href="{{ route('estimates.details', $estimate->customer->id) }}">
                            {{ $estimate->customer->display_name }}
                        </a>
                    </td>
                    <td class="text-center">
                        @if($estimate->status == 'DRAFT')
                            <div class="badge badge-dark">{{ $estimate->status }}</div>
                        @elseif($estimate->status == 'SENT')
                            <div class="badge badge-info">{{ $estimate->status }}</div>
                        @elseif($estimate->status == 'VIEWED')
                            <div class="badge badge-primary">{{ $estimate->status }}</div>
                        @elseif($estimate->status == 'EXPIRED')
                            <div class="badge badge-danger">{{ $estimate->status }}</div>
                        @elseif($estimate->status == 'ACCEPTED')
                            <div class="badge badge-success">{{ $estimate->status }}</div>
                        @elseif($estimate->status == 'REJECTED')
                            <div class="badge badge-danger">{{ $estimate->status }}</div>
                        @endif
                    </td>
                    <td class="text-right">
                        {{ money($estimate->total, $estimate->currency_code) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_due_estimates') }}</p>
    </div>
@endif