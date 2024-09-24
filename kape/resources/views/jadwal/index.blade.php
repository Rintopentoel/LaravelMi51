<table class="table">
    <tr>
        <th>Ruang</th>
        <th>Tanggal Servis Awal</th>
        <th>Tanggal Servis Selanjutnya</th>
        <th>Status</th>
    </tr>
@foreach ($hasil as $row)
    <!-- nama kolom -->
    <!-- sesuaikan dengan kolom masing-masing -->
     <tr>
        <td>
            {{ $row['ruang_id'] }}
        </td>
        <td>
            {{ $row['tanggal'] }}
        </td>
        <td>
           {{ $row['tanggal_servis_selanjutnya'] }} 
        </td>
        <td>
            {{ $row['status'] }}  
        </td>
    </tr>       
@endforeach