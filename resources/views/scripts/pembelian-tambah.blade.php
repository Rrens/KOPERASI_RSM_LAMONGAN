<script>
    $('#btn_save').on('click', function() {
        let data = [];

        $('#table_tambah tbody tr').each(function() {
            const nama_barang = $(this).find('td:eq(1)')[0]['innerText'];
            const kategori = $(this).find('td:eq(2)')[0]['innerText'];
            const jumlah_barang = $(this).find('td:eq(3)')[0]['innerText'];
            const harga_beli = $(this).find('td:eq(4)')[0]['innerText'];
            const harga_jual = $(this).find('td:eq(5)')[0]['innerText'];
            const total_harga = $(this).find('td:eq(6)')[0]['innerText'];
            const keterangan = $(this).find('td:eq(7)')[0]['innerText'];

            data.push({
                nama_barang,
                jumlah_barang,
                kategori,
                keterangan,
                harga_beli,
                harga_jual,
                total_harga
            });
        });
        // console.log(data);
        $.ajax({
            url: '/pembelian',
            type: 'POST',
            dataType: "json",
            data: {
                data: data,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(error, xhr, status);
            }
        })
    })

    function tambahBaris() {
        // console.log(nama_barang, kategori, keterangan, harga_beli, harga_jual, total_harga)
        let nama_barang = $('#nama_barang').val();
        let jumlah_barang = $('#jumlah_barang').val();
        let kategori = $('#kategori').val();
        let keterangan = $('#keterangan').val();
        let harga_beli = $('#harga_beli').val();
        let harga_jual = $('#harga_jual').val();
        let total_harga = $('#total_harga').val();
        // console.log(nama_barang)

        const newRow = `
                <tr>
                    <td class="text-bold-500">
                        <button class="btn btn-outline-danger" name="delete_row" onclick="deleteRow(this)">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                    <td class="text-bold-500">
                        ${nama_barang}
                    </td>
                    <td class="text-bold-500">
                        ${kategori}
                    </td>
                    <td class="text-bold-500">
                        ${jumlah_barang}
                    </td>
                    <td class="text-bold-500">
                        ${harga_beli}
                    </td>
                    <td class="text-bold-500">
                        ${harga_jual}
                    </td>
                    <td class="text-bold-500">
                        ${total_harga}
                    </td>
                    <td class="text-bold-500">
                        ${keterangan}
                    </td>
                </tr>
        `

        $('#table_tambah tbody').append(newRow);
    }

    function deleteRow(btn) {
        var row = btn.closest('tr');
        row.remove();
    }
</script>
