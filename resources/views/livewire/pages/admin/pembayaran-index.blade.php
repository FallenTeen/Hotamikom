<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pembayaran') }}
        </h2>
    </x-slot>

    <div class="w-full h-full mt-8 font-poppins">
        <div class="bg-white  px-12 py-8 rounded-lg flex flex-col">
            <div class="justify-between flex items-center">
                <span class="text-2xl font-bold">Tabel Kelola Pembayaran</span>
                <div class="w-2/4 flex items-center justify-end gap-2">
                    <div class="w-1/2">
                        <form class="flex items-center">
                            <label for="voice-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.500ms="cari"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Cari Pembayaran" required />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto pt-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('id_reservasi')">
                                ID Reservasi
                                @if ($sort === 'id_reservasi')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif

                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer"
                                wire:click="sortBy('id_reservasi->user->name')">
                                Nama Tamu
                                @if ($sort === 'id_reservasi->user->name')
                                    @if ($direction === 'asc')
                                        <span class="absolute">&uarr;</span>
                                    @else
                                        <span class="absolute">&darr;</span>
                                    @endif
                                @endif

                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer">
                                Checkin
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer">
                                Checkout
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer ">
                                Tagihan
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer text-center">
                                Metode Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer text-center">
                                Status Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans as $pay)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pay->id_reservasi }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pay->reservasi->user->name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pay->reservasi->tgl_checkin }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pay->reservasi->tgl_checkout }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pay->reservasi->total_harga }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <!-- Check if metode_pembayaran is 'cash' -->
                                    @if($pay->metode_pembayaran === 'cash')
                                        <div class="flex items-center text-center justify-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                            </svg>
                                            Cash
                                        </div>
                                    @elseif($pay->metode_pembayaran === 'transfer')
                                        <div class="flex justify-center items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                            </svg>
                                            Transfer
                                        </div>
                                    @else
                                        {{ $pay->metode_pembayaran }}
                                    @endif
                                </td>

                                <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex space-x-2 justify-center items-center">
                                        @if(($pay->reservasi->status === 'completed'))
                                            <div class="bg-green-500 text-white py-1 px-2 rounded-md">Reservasi Selesai</div>
                                        @else
                                            @if($pay->status_pembayaran === 'pending')
                                                <button
                                                    class=" hover:scale-105 duration-150 px-4 py-2 rounded-md bg-yellow-300 text-yellow-800 border border-yellow-500"
                                                    wire:click="updateStatus('pending', {{ $pay->id }})">
                                                    Pending
                                                </button>
                                            @else
                                                <button
                                                    class="hover:scale-105 duration-150 px-4 py-2 rounded-md bg-gray-200 text-gray-600 border border-gray-300"
                                                    wire:click="updateStatus('pending', {{ $pay->id }})">
                                                    Pending
                                                </button>
                                            @endif

                                            @if($pay->status_pembayaran === 'approved')
                                                <button
                                                    class="hover:scale-105 duration-150 px-4 py-2 rounded-md bg-green-500 text-white border border-green-700"
                                                    wire:click="updateStatus('approved', {{ $pay->id }})">
                                                    Approved
                                                </button>
                                            @else
                                                <button
                                                    class="hover:scale-105 duration-150 px-4 py-2 rounded-md bg-gray-200 text-gray-600 border border-gray-300"
                                                    wire:click="updateStatus('approved', {{ $pay->id }})">
                                                    Approved
                                                </button>
                                            @endif
                                            @if($pay->status_pembayaran === 'canceled')
                                                <button
                                                    class="hover:scale-105 duration-150 px-4 py-2 rounded-md bg-red-500 text-white border border-red-700"
                                                    wire:click="updateStatus('canceled', {{ $pay->id }})">
                                                    Canceled
                                                </button>
                                            @else
                                                <button
                                                    class="hover:scale-105 duration-150 px-4 py-2 rounded-md bg-gray-200 text-gray-600 border border-gray-300"
                                                    wire:click="updateStatus('canceled', {{ $pay->id }})">
                                                    Canceled
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 justify-center grid items-center">
                                    <button wire:click="delete({{ $pay->id }})"
                                        class="bg-red-500 text-white px-4 py-1 rounded">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
            <div class="mt-4">
                {{ $pembayarans->links() }}
            </div>
        </div>
    </div>
</div>