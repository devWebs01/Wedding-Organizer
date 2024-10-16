<div class="card d-print-block border-0">
    <div class="card-header py-4 row">
        <div class="col-md">
            <h4>Pesanan</h4>
            <p>Waktu Acara : <strong>{{ \carbon\Carbon::parse($order->wedding_date)->format('d M Y') }}</strong></p>
            <p>Metode Pembayaran : <strong>{{ $order->payment_method }}</strong></p>
            <p>Note : <strong>{{ $order->note }}</strong></p>

        </div>
        <div class="col-md text-lg-end">
            <h4>Pelanggan</h4>
            <p>{{ $order->user->name }}</p>
            <p> {{ $order->user->email }}</p>
            <p>{{ $order->user->telp }}</p>
            <p>{{ $order->user->address->province->name }},
                {{ $order->user->address->city->name }}</p>
            <p> {{ $order->user->address->details }}</p>
        </div>
    </div>

    <div class="card-body table-responsive row px-0">
        <table class="table table-borderless">
            <thead>
                <tr class="border">
                    <th class="text-center">#</th>
                    <th>Produk</th>
                    <th class="text-center">Variant</th>
                    <th class="text-end">Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $no => $item)
                    <tr class="border">
                        <td class="text-center">{{ ++$no }}</td>

                        <td>{{ Str::limit($item->product->title, 30, '...') }}</td>

                        <td class="text-center">{{ $item->variant->name }}</td>

                        <td class="text-end">
                            {{ formatRupiah($item->variant->price) }}
                        </td>
                    </tr>
                @endforeach

                <tr class="text-end">
                    <td colspan="2"></td>
                    <td class="text-center fw-bolder"> Sub - Total:</td>
                    <td class="fw-bolder text-dark">
                        {{ 'Rp.' .
                            Number::format(
                                $order->items->sum(function ($item) {
                                    return $item->variant->price;
                                }),
                                locale: 'id',
                            ) }}
                    </td>
                </tr>
                <tr class="text-end">
                    <td colspan="2"></td>
                    <td class="text-center fw-bolder"> Total:</td>
                    <td class="fw-bolder text-dark">
                        {{ formatRupiah($order->total_amount) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-footer row">
        <div class="col-12">
            <span class="fw-medium text-heading">Note:</span>
            <span>{{ $order->note }}</span>
        </div>
    </div>


    <div class="card-body row px-0 gap-4">

        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Halo! 😊</h4>
            <p> Kami ingin mengingatkan kamu untuk menyelesaikan pembayaran agar pesanan kamu dapat segera diproses.
                Kami sangat menghargai perhatian kamu dan ingin memastikan semuanya berjalan lancar.</p>
        </div>

        @foreach ($order->payments as $item)
            <div class="col-md border p-3 rounded">
                <div class="row">
                    <div class="col-md">
                        <h4 class="text-center fw-bold">{{ $item->payment_type }}</h4>

                        <h6 class="text-center my-2">{{ formatRupiah($item->amount) }}</h6>
                    </div>
                    <div class="col-md">
                        <h3 class="text-center mt-3">{{ $item->payment_status }}</h3>
                    </div>
                </div>


                @if ($item->proof_of_payment)
                    <div class="text-center">
                        <a data-fslightbox="mygalley" class="rounded" target="_blank" data-type="image"
                            href="{{ Storage::url($item->proof_of_payment) }}">
                            <img src="{{ Storage::url($item->proof_of_payment) }}" class="img object-fit-cover rounded"
                                style="height: 550px; width: 100%" alt="proof_of_payment1" />
                        </a>
                    </div>
                @else
                    <div class="card placeholder" style="height: 550px; width: 100%">
                    </div>

                    <a href="{{ route('order.payment', ['payment' => $item->id ]) }}" class="btn btn-dark mt-3 d-grid">
                        Lakukan Pembayaran
                    </a>
                @endif

            </div>
        @endforeach
    </div>


</div>
