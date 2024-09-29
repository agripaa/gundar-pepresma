@extends('layouts.app-admin')

@section('title', 'List Prestasi')

@section('content')

<!-- Filters -->
<div class="flex items-center justify-between my-6">
    <!-- Date and Dropdowns -->
    <div class="flex items-center space-x-4">
        <!-- Rentang Tanggal -->
        <div class="flex items-center space-x-2 bg-gray-200 text-gray-700 px-4 rounded-lg">
            <input type="month" class="bg-gray-200 text-gray-700 rounded-lg p-2 w-32" id="startMonth" name="startMonth" placeholder="Start Month">
            <span>s/d</span>
            <input type="month" class="bg-gray-200 text-gray-700 rounded-lg p-2 w-32" id="endMonth" name="endMonth" placeholder="End Month">
        </div>

        <!-- Fakultas Filter -->
        <select class="bg-gray-200 px-4 py-2 rounded-lg" id="facultyFilter">
            <option value="">Fakultas</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
            @endforeach
        </select>

        <!-- Kategori Lomba Filter -->
        <select class="bg-gray-200 px-4 py-2 rounded-lg" id="categoryFilter">
            <option value="">Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->kategori }}</option>
            @endforeach
        </select>
    </div>

    <!-- Download & Search Bar -->
    <div class="flex items-center space-x-4">
        <a id="downloadExcel" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:cursor-pointer">
            Download Excel
        </a>
        <div class="relative">
            <input type="text" class="bg-gray-200 px-4 py-2 rounded-lg" id="searchBar" placeholder="Search by NIM, Name, Dosen, or NIDN...">
        </div>
    </div>
</div>


<!-- Table -->
<div class="bg-white rounded-lg shadow-md" style="max-height: 750px; overflow-y: auto;">
    <table class="max-w-full bg-white overflow-x-auto">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-3 px-6 text-center">NO</th>
                <th class="py-3 px-6 text-center">NIM</th>
                <th class="py-3 px-6 text-center">NAMA</th>
                <th class="py-3 px-6 text-center">PRODI</th>
                <th class="py-3 px-6 text-center">KEPESERTAAN</th>
                <th class="py-3 px-6 text-center">KATEGORI</th>
                <th class="py-3 px-6 text-center">JENIS PRESTASI</th>
                <th class="py-3 px-6 text-center">NAMA KEGIATAN</th>
                <th class="py-3 px-6 text-center">JUDUL PROGRAM</th>
                <th class="py-3 px-6 text-center">LOKASI KEGIATAN</th>
                <th class="py-3 px-6 text-center">TANGGAL MULAI</th>
                <th class="py-3 px-6 text-center">TANGGAL SELESAI</th>
                <th class="py-3 px-6 text-center">NAMA PENYELENGGARA</th>
                <th class="py-3 px-6 text-center">JUMLAH NEGARA</th>
                <th class="py-3 px-6 text-center">JUMLAH PESERTA</th>
                <th class="py-3 px-6 text-center">JUMLAH TIM</th>
                <th class="py-3 px-6 text-center">JUMLAH PERGURUAN TINGGI</th>
                <th class="py-3 px-6 text-center">CAPAIAN PRESTASI</th>
                <th class="py-3 px-6 text-center">POSISI</th>
                <th class="py-3 px-6 text-center">DOSEN PENDAMPING</th>
                <th class="py-3 px-6 text-center">NIDN</th>
                <th class="py-3 px-6 text-center">URL / LINK PUBLIKASI</th>
                <th class="py-3 px-6 text-center">NOMOR SURAT TUGAS</th>
                <th class="py-3 px-6 text-center">TANGGAL SURAT TUGAS</th>
                <th class="py-3 px-6 text-center">LAMPIRAN</th>
                <th class="py-3 px-6 text-center">ACTION</th>
            </tr>
        </thead>
        <tbody class="text-gray-700" id="prestasiTableBody">
            <!-- Data rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4 px-4 flex justify-between items-center"> 
    <div class="flex items-center space-x-2" id="paginationLinks"></div>
</div>


<!-- Modal -->
<div id="lampiranModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <div class="flex border-b border-black  justify-between items-center mb-4">
                <h3 class="text-xl mb-2 font-semibold">Lampiran</h3>
                <button class="text-gray-600 mb-2 text-2xl hover:text-gray-900" id="closeModal">&times;</button>
            </div>
            <div id="modalContent">
                <!-- Isi Modal Lampiran -->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        const startMonth = document.getElementById('startMonth');
        const endMonth = document.getElementById('endMonth');
        const facultyFilter = document.getElementById('facultyFilter');
        const categoryFilter = document.getElementById('categoryFilter');
        const searchBar = document.getElementById('searchBar');
        const downloadExcelButton = document.getElementById('downloadExcel');

        function buildExportUrl() {
            // Check if any filters are applied
            const filtersApplied = startMonth.value || endMonth.value || facultyFilter.value || categoryFilter.value || searchBar.value;

            if (filtersApplied) {
                // If filters are applied, build the URL with filters
                const query = new URLSearchParams({
                    startMonth: startMonth.value,
                    endMonth: endMonth.value,
                    faculty_id: facultyFilter.value,
                    category_id: categoryFilter.value,
                    search: searchBar.value
                }).toString();

                const fullUrl = `/export-prestasi?${query}`;
                downloadExcelButton.href = fullUrl;
                console.log('Export URL with filters:', fullUrl); // This will log the generated URL with filters
            } else {
                // If no filters are applied, download all data
                const fullUrl = `/export-prestasi`; // No query params means downloading all data
                downloadExcelButton.href = fullUrl;
                console.log('Export URL for all data:', fullUrl); // This will log the generated URL for all data
            }
        }

        // Update the export URL whenever the filters change
        startMonth.addEventListener('change', buildExportUrl);
        endMonth.addEventListener('change', buildExportUrl);
        facultyFilter.addEventListener('change', buildExportUrl);
        categoryFilter.addEventListener('change', buildExportUrl);
        searchBar.addEventListener('input', buildExportUrl);

        // Ensure the initial buildExportUrl is called to handle no-filter downloads
        buildExportUrl();
    });




    document.addEventListener('DOMContentLoaded', function () {
        const lampiranButtons = document.querySelectorAll('.view-lampiran');

        // Pasang event listener untuk setiap tombol
        lampiranButtons.forEach((button, index) => {
            button.addEventListener('click', function () {
                const prestasiId = button.getAttribute('data-id');
                fetchLampiran(prestasiId);
            });
        });

        // Event Listener untuk menutup modal
        document.getElementById('closeModal').addEventListener('click', function () {
            const modalElement = document.getElementById('lampiranModal');
            modalElement.classList.add('hidden');
        });

    });

    document.addEventListener('DOMContentLoaded', function () {
    const startMonth = document.getElementById('startMonth');
    const endMonth = document.getElementById('endMonth');
    const facultyFilter = document.getElementById('facultyFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const searchBar = document.getElementById('searchBar');
    const prestasiTableBody = document.getElementById('prestasiTableBody');
    const paginationLinks = document.getElementById('paginationLinks');
    const paginationSummary = document.getElementById('paginationSummary');

    function fetchPrestasi(page = 1) {
        const query = {
            startMonth: startMonth.value,
            endMonth: endMonth.value,
            faculty_id: facultyFilter.value,
            category_id: categoryFilter.value,
            search: searchBar.value,
            page: page
        };


        fetch('/get-prestasi?' + new URLSearchParams(query))
            .then(response => response.json())
            .then(data => {
                prestasiTableBody.innerHTML = '';
                
                if (data.prestasi.length === 0) {
                    prestasiTableBody.innerHTML = '<tr><td colspan="25" class="text-center py-4">No data available</td></tr>';
                } else {
                    data.prestasi.forEach((p, index) => {
                        const mahasiswa = p.mahasiswa || {};
                        const dosenPembimbing = p.dosen_pembimbing || {};
                        const partisipan = p.partisipan || {};
                        prestasiTableBody.innerHTML += `
                            <tr class="border-b border-gray-300">
                                <td class="py-3 px-6 text-center">${ index + 1 }</td>
                                <td class="py-3 px-6 text-center">${ mahasiswa.NIM || '-' }</td>
                                <td class="py-3 px-6 text-center">${ mahasiswa.nama || '-' }</td>
                                <td class="py-3 px-6 text-center">${ mahasiswa.prodi?.study_program || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.kepesertaan?.jenis_kepesertaan || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.kategori?.kategori || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.jenis_prestasi?.prestasi || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.nama_kegiatan }</td>
                                <td class="py-3 px-6 text-center">${ p.judul_karya }</td>
                                <td class="py-3 px-6 text-center">${ p.lokasi_kegiatan }</td>
                                <td class="py-3 px-6 text-center">${ p.tanggal_mulai }</td>
                                <td class="py-3 px-6 text-center">${ p.tanggal_selesai }</td>
                                <td class="py-3 px-6 text-center">${ p.nama_penyelenggara }</td>
                                <td class="py-3 px-6 text-center">${ partisipan.jumlah_partisipan_negara || '-' }</td>
                                <td class="py-3 px-6 text-center">${ partisipan.jumlah_partisipan_peserta || '-' }</td>
                                <td class="py-3 px-6 text-center">${ partisipan.jumlah_partisipan_team || '-' }</td>
                                <td class="py-3 px-6 text-center">${ partisipan.jumlah_partisipan_kampus || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.capaian?.jenis_juara || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.posisi?.posisi || '-' }</td>
                                <td class="py-3 px-6 text-center">${ dosenPembimbing.nama || '-' }</td>
                                <td class="py-3 px-6 text-center">${ dosenPembimbing.NIDN || '-' }</td>
                                <td class="py-3 px-6 text-center">${ p.penyelenggara }</td>
                                <td class="py-3 px-6 text-center">${ p.nomor_surat_tugas }</td>
                                <td class="py-3 px-6 text-center">${ p.tanggal_surat_tugas }</td>
                                <td class="py-3 px-6 text-center">
                                    <button class="bg-gray-100 hover:bg-gray-200 rounded-full p-2 view-lampiran" data-id="${ p.id }">
                                        <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg>
                                    </button>
                                </td>   
                                <td class="flex py-3 h-auto text-center items-center justify-center">
                                    <a href="/prestasi/${p.id}/edit" class="mx-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">Edit</a>

                                    <form action="/prestasi/${p.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this prestasi?');" class="inline-block mx-2">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                                            Delete
                                        </button>
                                    </form>
                                </td>             
                            </tr>`;
                    });
                }

                paginationLinks.innerHTML = data.pagination;

            })
            .catch(error => console.error('Error fetching prestasi:', error));
    }

    // Trigger filtering when user changes any filter
    startMonth.addEventListener('change', () => fetchPrestasi(1));
    endMonth.addEventListener('change', () => fetchPrestasi(1));
    facultyFilter.addEventListener('change', () => fetchPrestasi(1));
    categoryFilter.addEventListener('change', () => fetchPrestasi(1));
    searchBar.addEventListener('input', () => fetchPrestasi(1));

    // Event delegation to handle dynamic content for view-lampiran buttons
    document.addEventListener('click', function (event) {
        if (event.target.closest('.view-lampiran')) {
            const button = event.target.closest('.view-lampiran');
            const prestasiId = button.getAttribute('data-id');
            fetchLampiran(prestasiId);
        }

        if (event.target.matches('.pagination-link')) {
            event.preventDefault();
            const page = event.target.dataset.page;
            fetchPrestasi(page);
        }
    });

    // Fetch Lampiran data
    function fetchLampiran(id) {
        fetch(`/get-lampiran/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                let modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = ''; // Clear previous content

                // Add the content to the modal
                if (data.files && data.files.length > 0) {
                    data.files.forEach(file => {
                        if (file.type === 'pdf') {
                            modalContent.innerHTML += `
                                <div class="mb-4">
                                    <h4 class="font-semibold">${file.name}</h4>
                                    <a href="${file.url}" target="_blank" class="text-blue-500 hover:underline">View ${file.name}</a>
                                </div>`;
                        } else if (file.type === 'image') {
                            modalContent.innerHTML += `
                                <div class="mb-4">
                                    <h4 class="font-semibold">${file.name}</h4>
                                    <img src="${file.url}" class="w-full h-64 object-contain mb-2" alt="${file.name}" />
                                </div>`;
                        }
                    });
                } else {
                    modalContent.innerHTML = '<p>No files available</p>';
                }

                // Show the modal
                const modalElement = document.getElementById('lampiranModal');
                modalElement.classList.remove('hidden');
            })
            .catch(error => console.error('Error fetching lampiran:', error));
    }

    // Close modal listener
    document.getElementById('closeModal').addEventListener('click', function () {
        const modalElement = document.getElementById('lampiranModal');
        modalElement.classList.add('hidden');
    });

    // Initial fetch
    fetchPrestasi();
});


    function fetchProdi(prodiId) {
        fetch(`/get-prodi/${prodiId}`)
            .then(response => response.json())
            .then(data => {
                let prodiCell = document.getElementById(`prodi-${prodiId}`);
                if (data.study_program) {
                    prodiCell.innerText = data.study_program;
                } else {
                    prodiCell.innerText = '-';
                }
            })
            .catch(error => {
                let prodiCell = document.getElementById(`prodi-${prodiId}`);
                prodiCell.innerText = '-';
            });
    }

    // Call fetchProdi for each prodi ID
    document.addEventListener('DOMContentLoaded', function () {
        let prodiCells = document.querySelectorAll('[id^=prodi-]');
        prodiCells.forEach(cell => {
            let prodiId = cell.id.replace('prodi-', ''); // Extract prodiId from the id attribute
            console.log(prodiId)
            fetchProdi(prodiId);
        });
    });

</script>
@endsection
