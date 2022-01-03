$(document).ready(function () {

    // Yüklenmeyen görsellere varsayilan görsel atamak için .
    function showNoPhotoIcon(e) {
        const image = e.target;
        image.removeEventListener('error', showNoPhotoIcon);
        image.src = '../images/kitapresim/varsayilankitapresmi.png'
    }
    function resimHataYakala() {
        document.querySelectorAll('img').forEach(img => {
            if (img.naturalWidth === 0) {
                img.addEventListener('error', showNoPhotoIcon);
                img.src = img.src;
            }
        });
    }
    resimHataYakala();

    //  Ajax modunu ssp sınıfını kullanırken her  datatableye özel get parametresi yollamak amaçlı kullanıyorum.
    var ajaxModu = $('#example1').data("ajaxid");
    $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: `ajax/ajax.php?mode=${ajaxModu}`,
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
        columnDefs: [{
        }],
        order: [[1, 'asc']],
        "responsive": true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "autoWidth": false,
        "buttons": [
            {
                extend : "csv",
                exportOptions: {
                    columns: 'th:not(:last-child)'
                 }
            },
            {
                extend : "excel",
                exportOptions: {
                    columns: 'th:not(:last-child)'
                 }
            },
            {
                extend : "pdf",
                exportOptions: {
                    columns: 'th:not(:last-child)'
                 }
            },
            {
                extend : "print",
                exportOptions: {
                    columns: 'th:not(:last-child)'
                 }
            }
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');

    //  Tablomuz yeni veriler ile doldurulduktan sonra çalışan event .
    $('#example1').on('draw.dt', function () {
        // Tablo veriler ile dolduktan hemen sonra yeni oluşan sil butonlarının event listenerlerini güncelliyoruz . 
        silmeBtnClick();
        // Linki bozuk resimlere varsayilan görsle atıyoruz .
        resimHataYakala();
    });


    //Initialize Select2 Elements
    $('.select2').select2();


    // Summernote
    $('#summernote').summernote({
        height: 200
    })

    //  SİLME BUTONU SWEET ALERT UYARISI
    function silmeBtnClick() {
        $('.silbuton').each(function () {
            $(this).on("mousedown touchstart", function (e) {
                e.preventDefault();
                const gidilecekLink = $(this).attr("href");
                Swal.fire({
                    title: 'Silme işlemi yapmak istediğinizden emin misiniz (Geri dönüşü olmayabilir) ? ',
                    icon: "info",
                    showDenyButton: true,
                    confirmButtonText: `Sil`,
                    denyButtonText: `Vazgeç`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace(gidilecekLink);
                    } else if (result.isDenied) {
                        Swal.fire('İşlem iptal edildi', '', 'info')
                    }
                })

            })
        });
    }
    //  ÖDÜNÇ TESLİM AL BUTONU SWEET ALERT UYARISI

    $("#oduncTeslimAlBtn").on("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Teslim almak istediğinizden emin misiniz ? ',
            icon: "info",
            showDenyButton: true,
            confirmButtonText: `Teslim Al`,
            denyButtonText: `Vazgeç`,
        }).then((result) => {
            if (result.isConfirmed) {
                $("#oduncTeslimAlForm").submit();
            } else if (result.isDenied) {
                Swal.fire('İşlem iptal edildi', '', 'info')
            }
        })
    })
})