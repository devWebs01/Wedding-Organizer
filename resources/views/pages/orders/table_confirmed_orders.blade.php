<div class="table-responsive">
    <table class="table text-center">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Total Pesanan</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($confirmed_orders as $no => $item)
                <tr>
                    <th>{{ ++$no }}</th>
                    <td>{{ $item->invoice }}</td>
                    <td>{{ $item->tracking_number }}</td>
                    <td>
                        <span class="badge rounded-pill p-2 text-custom border">
                            {{ __('status.' . $item->status) }}
                        </span>
                    </td>
                    <td>{{ formatRupiah($item->total_amount) }}
                    </td>
                    <td>
                        <a wire:navigate href="/orders/{{ $item->id }}"
                            class="btn btn-sm btn-outline-dark">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $confirmed_orders->links() }}
    </table>
</div>