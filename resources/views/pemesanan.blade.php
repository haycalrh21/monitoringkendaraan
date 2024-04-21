<x-guest-layout>


    <div>
        <form method="POST" action="{{ route('kirimpemesanan') }}">
            @csrf
            <label for="nama" class="block mb-2">Nama Pegawai:</label>
            <input type="text" x-model="name" id="nama" name="nama" class="border border-gray-300 p-2 w-full"
                required>

            <label for="nama" class="block mb-2">Pilih Kendaraan</label>
            <select name="nama_kendaraan" required>
                <option value="">Pilih</option>
                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}"">
                        {{ $kendaraan->nama_kendaraan }} ({{ $kendaraan->plat_nomor }})
                    </option>
                @endforeach
            </select>
            <div>

                <button type="submit"
                    class="mt-4 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Kirim</button>
            </div>

        </form>
    </div>
</x-guest-layout>
