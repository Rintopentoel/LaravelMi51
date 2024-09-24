<table class="table">
    <tr>
        <th>Nama Ruang</th>
        <th>lantai</th>
    </tr>
    @foreach ($hasil as $row)
    <!-- nama kolom -->
    <!-- sesuaikan dengan kolom masing-masing -->
     <tr>
        <td>
            {{ $row['nama_ruang'] }}
        </td>
        <td>

            {{ $row['lantai'] }}
        </td>
    </tr>       
    @endforeach
</table>