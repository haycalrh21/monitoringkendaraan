<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>
                Halaman Persetujuan
            </p>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-black">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-black">No</th>
                                    {{-- <th class="border border-black">Id</th> --}}
                                    <th class="border border-black">Nama Pegawai</th>
                                    <th class="border border-black">Nama Kendaraan</th>
                                    <th class="border border-black">Status 1</th>
                                    <th class="border border-black">Status 2</th>
                                    <th class="border border-black">aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $key => $pemesanan)
                                    <tr class="border border-black">
                                        <td class="border border-black">{{ $key + 1 }}</td>
                                        {{-- <td class="border border-black">{{ $pemesanan->id }}</td> --}}
                                        <td class="border border-black text-center">{{ $pemesanan->nama }}</td>
                                        <td class="border border-black text-center">{{ $pemesanan->nama_kendaraan }}
                                        </td>
                                        <td class="border border-black text-center">{{ $pemesanan->status1 }}</td>
                                        <td class="border border-black text-center">{{ $pemesanan->status2 }}</td>
                                        <td class="border border-black text-center">
                                            {{-- Form untuk mengirimkan permintaan PUT --}}
                                            <form action="{{ route('gantistatus', $pemesanan->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                {{-- Tambahkan input tersembunyi untuk menyimpan status yang akan diubah --}}
                                                <input type="hidden" name="status"
                                                    value="{{ $pemesanan->status1 === 'Belum Disetujui' ? 'Disetujui' : ($pemesanan->status2 === 'Belum Disetujui' ? 'Disetujui' : 'Belum Disetujui') }}">
                                                {{-- Tambahkan tombol untuk mengirimkan formulir --}}
                                                <button type="submit" class="bg-yellow-300 rounded p-1">
                                                    @if ($pemesanan->status1 === 'Belum Disetujui')
                                                        Setujui Status 1
                                                    @elseif ($pemesanan->status2 === 'Belum Disetujui')
                                                        Setujui Status 2
                                                    @else
                                                        Status Sudah Disetujui
                                                    @endif
                                                </button>
                                            </form>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
