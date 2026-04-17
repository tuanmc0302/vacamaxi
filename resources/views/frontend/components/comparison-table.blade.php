@php
    $headers = $comparison['headers'] ?? [];
    $rows = $comparison['rows'] ?? $comparison;
@endphp
<table class="comparison-table">
    @if (!empty($headers))
        <tr>
            @foreach ($headers as $cell)
                <th>{{ $cell }}</th>
            @endforeach
        </tr>
    @endif
    @foreach ($rows as $row)
        <tr>
            @foreach ($row as $cell)
                <td>{{ $cell }}</td>
            @endforeach
        </tr>
    @endforeach
</table>