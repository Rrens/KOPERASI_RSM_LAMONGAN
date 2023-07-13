<script>
    $('#metode_pembayaran').on('click', function(e) {
        let metode_pembayaran = e.target.value;
        let id_pelanggan = $('#id_pelanggan').val();
        let kredit = $('#credit').val();

        // if (kredit < 300000) {
        //     $('#option_kredit').attr('hidden', true);
        // }

        if (!id_pelanggan) {
            $('#option_kredit').attr('hidden', true);
            $('#btn_save').attr('hidden', false);
        } else if (id_pelanggan) {
            if (kredit >= 300000) {
                $('#option_kredit').attr('hidden', true);
            } else {
                $('#option_kredit').attr('hidden', false);
            }
            $('#btn_save').attr('hidden', false);
        }

        if (metode_pembayaran == 'tunai') {

            $('#isTunai').attr('hidden', false);
        } else if (metode_pembayaran == 'kredit') {
            $('#isTunai').attr('hidden', true);
            $('#uang_bayar').val('');
            $('#kembalian').val('');
        }

    })

    $('#id_pelanggan').on('change', function(e) {
        var id_pelanggan = e.target.value;
        $.ajax({
            url: `/penjualan/get-id-anggota/${id_pelanggan}`,
            method: 'GET',
            success: function(data) {
                $('#id_anggota').val(data.id);
                $('#nama_anggota').val(data.name);
                $('#poin').val(data.poin);
                $('#credit').val(data.credit);
            },
            error: function() {

                $('#id_anggota').val('');
                $('#nama_anggota').val('');
                $('#poin').val('');
                $('#credit').val('');
            }
        })

    });

    $('#tukar_poin').on('click', function() {
        $('#jumlah_poin').val($('#poin').val())
        // alert($('#jumlah_poin').val())
    })

    $('#hitung_sub_total').on('click', function(e) {
        e.stopPropagation();

        var harga_total = [];
        var id_anggota = $('#id_pelanggan').val();
        var poin = $('#jumlah_poin').val() * 3000;
        var metode_pembayaran = $('#metode_pembayaran').val();


        $('#table_kasir tbody tr').each(function() {
            var harga_akhir = $(this).find('td:eq(6)')[0]['innerText'];
            harga_total.push({
                harga_akhir: harga_akhir
            });
        });
        let sum = 0;

        harga_total.forEach(value => {
            sum += parseInt(value['harga_akhir']);
        });

        if (metode_pembayaran) {
            if (metode_pembayaran == 'Pilih Metode Pembayaran') {
                $('#sub_total').val(sum - poin);
            } else if (metode_pembayaran == 'kredit') {
                $('#sub_total').val((sum - poin) + ((sum - poin) * 0.05));

            } else {
                $('#sub_total').val(sum - poin);
            }
        } else {
            $('#sub_total').val(sum - poin);
        }

        if (id_anggota) {
            $('#diskon').val(10);
            $('#hasil_diskon').val(sum * 0.1);

            if ($('#sub_total').val() >= 100000) {
                $('#tambahan_poin').val(1);
            }
            $('#nominal_bayar').val($('#sub_total').val() - $('#hasil_diskon').val())
        } else {
            $('#diskon').val('');
            $('#hasil_diskon').val('');
            $('#nominal_bayar').val(sum - poin)
        }


        // console.log(harga_total, `sum: ${sum}`);
        $('#uang_bayar').attr('readonly', false);


    })


    $('#uang_bayar').on('change', function() {

        var uang_bayar = $('#uang_bayar').val();
        var nominal_bayar = $('#nominal_bayar').val();
        // console.log(`UANG BAYAR: ${uang_bayar} NOMINAL BAYAR ${nominal_bayar}`)
        let checkUang = uang_bayar - nominal_bayar;

        if (checkUang < 0) {
            // console.log('kurang');
            alert('Uang kurang ' + (checkUang))
            $('#kembalian').val('');
        } else {
            console.log('lebih');
            $('#kembalian').val(checkUang);
        }
    })

    $('#btn_save').on('click', function() {
        let data = [];
        let data_detail = []

        $('#table_kasir tbody tr').each(function() {
            const id_barang = $(this).find('td:eq(1)')[0]['innerText'];
            const kategori = $(this).find('td:eq(2)')[0]['innerText'];
            const nama_barang = $(this).find('td:eq(3)')[0]['innerText'];
            const jumlah_barang = $(this).find('td:eq(4)')[0]['innerText'];
            const harga_jual = $(this).find('td:eq(5)')[0]['innerText'];
            const harga_akhir = $(this).find('td:eq(6)')[0]['innerText'];
            // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
            data_detail.push({
                id_barang,
                kategori,
                nama_barang,
                jumlah_barang,
                harga_jual,
                harga_akhir
            });

            const {
                id_pelanggan,
                tanggal,
                id_anggota,
                nama_anggota,
                poin,
                tukar_poin,
                credit,
                jumlah_poin,
                sub_total,
                diskon,
                hasil_diskon,
                nominal_bayar,
                uang_bayar,
                kembalian,
                metode_pembayaran,
                tambahan_poin
            } = $('#form_kasir').serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});

            data.push({
                id_pelanggan,
                tanggal,
                id_anggota,
                nama_anggota,
                poin,
                tukar_poin,
                credit,
                jumlah_poin,
                sub_total,
                diskon,
                hasil_diskon,
                nominal_bayar,
                uang_bayar,
                kembalian,
                metode_pembayaran,
                tambahan_poin
            });
        });


        $.ajax({
            url: '/penjualan',
            type: 'POST',
            dataType: "json",
            data: {
                data: data,
                data_detail: data_detail,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                _url = `/penjualan/print/${response.data}`
                location.href = _url;
            },
            error: function(xhr, status, error) {
                console.log(error, xhr, status);
            }
        })

        // location.reload();



        // setTimeout(function() {
        //     window.location.reload();
        // }, 2000);

        // location.reload();


    })



    function tambahBaris() {
        var stok = $('#stok').val();
        var harga_jual = $('#harga_jual').val();
        var jumlah_barang = $('#jumlah_barang').val();
        var harga_akhir = $('#harga_akhir').val();
        var id_barang = $('#id_barang').val();
        if (harga_akhir) {
            $.ajax({
                url: `/penjualan/get-id-product/${id_barang}`,
                method: 'GET',
                success: function(data) {
                    var newRow = `
                            <tr>
                                <td class="text-bold-500">
                                    <button class="btn btn-outline-danger" name="delete_row" onclick="deleteRow(this)">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                                <td class="text-bold-500">
                                    ${id_barang}
                                </td>
                                <td class="text-bold-500">
                                    ${data.kategori}
                                </td>
                                <td class="text-bold-500">
                                    ${data.nama}
                                </td>
                                <td class="text-bold-500">
                                    ${jumlah_barang}
                                </td>
                                <td class="text-bold-500">
                                    ${data.harga}
                                </td>
                                <td class="text-bold-500">
                                    ${harga_akhir}
                                </td>
                            </tr>
                        `;
                    $('#table_kasir tbody').append(newRow);
                }
            })
        }
    }



    function deleteRow(btn) {
        var row = btn.closest('tr');
        row.remove();
    }


    $('#id_barang').on('change', function(e) {
        var id_barang = e.target.value;

        $.ajax({
            url: `penjualan/get-id-product/${id_barang}`,
            method: 'GET',
            success: function(data) {
                var checkDataDouble = [];
                if ($('#table_kasir tbody tr').val() != null) {
                    $('#table_kasir tbody tr').each(function() {
                        var jumlah_barang = $(this).find('td:eq(4)')[0][
                            'innerText'
                        ];
                        var id_barang = $(this).find('td:eq(1)')[0][
                            'innerText'
                        ];
                        checkDataDouble.push({
                            jumlah_barang: jumlah_barang,
                            id_barang: id_barang
                        });
                    });
                    // console.log(checkDataDouble);
                    let sum = 0;
                    let data_id_barang = []
                    checkDataDouble.forEach(value => {
                        // console.log(`VALUE: ${value['jumlah_barang']}`)
                        if (parseInt(value['id_barang']) == id_barang) {
                            sum += parseInt(value['jumlah_barang']);
                        }
                        data_id_barang.push({
                            id_barang: value['id_barang'],
                            jumlah_barang: sum
                        });
                    });
                    // console.log(sum)
                    var stok_awal = data.stok - sum;
                    $('#stok').val(stok_awal);
                } else {
                    var stok_awal = data.stok;
                    $('#stok').val(stok_awal);
                }

                $('#harga_jual').val(data.harga);

                $('#jumlah_barang').on('change', function(e) {
                    var checkDataDouble = [];
                    if ($('#table_kasir tbody tr').val() != null) {
                        $('#table_kasir tbody tr').each(function() {
                            var jumlah_barang = $(this).find('td:eq(4)')[0][
                                'innerText'
                            ];
                            var id_barang = $(this).find('td:eq(1)')[0][
                                'innerText'
                            ];
                            checkDataDouble.push({
                                jumlah_barang: jumlah_barang,
                                id_barang: id_barang
                            });
                        });
                        console.log(checkDataDouble);
                        let sum = 0;
                        let data_id_barang = []
                        checkDataDouble.forEach(value => {
                            console.log(`VALUE: ${value['jumlah_barang']}`)
                            if (parseInt(value['id_barang']) == id_barang) {
                                sum += parseInt(value['jumlah_barang']);
                            }
                            data_id_barang.push({
                                id_barang: value['id_barang'],
                                jumlah_barang: sum
                            });
                        });
                        // console.log(sum)
                        var stok_awal = data.stok - sum;
                        var jumlah_barang = e.target.value;
                        var stok_final = stok_awal - jumlah_barang;
                        var harga_akhir = data.harga * jumlah_barang;
                        $('#stok').val(stok_final);
                        $('#harga_akhir').val(harga_akhir);
                    } else {
                        var stok_awal = data.stok;
                        var jumlah_barang = e.target.value;
                        var stok_final = stok_awal - jumlah_barang;
                        var harga_akhir = data.harga * jumlah_barang;
                        $('#stok').val(stok_final);
                        $('#harga_akhir').val(harga_akhir);
                    }
                })
            }
        })
    })
</script>
