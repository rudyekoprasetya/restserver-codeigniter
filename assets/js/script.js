//function untuk ambil data dari Rest API
function tampil_data() {
    $.ajax({
        method: 'GET',
        url: 'http://localhost/restserver/pengurus',
        dataType: 'json',
        success: function(result) {
            console.log(result);
            var data='';    
 
            //perulangan untuk pasrng data JSON ke HTML
            $.each(result.data, function(i, item){
                data+='<tr>';
                  data+='<td>'+item.id+'</td>';
                  data+='<td>'+item.nama+'</td>';
                  data+='<td>'+item.alamat+'</td>';
                  data+='<td>'+item.gender+'</td>';
                  data+='<td>'+item.gaji+'</td>';
                  data+='<td><button class="btn btn-info btn-edit" data="'+item.id+'" data-toggle="modal" data-target="#Modaledit">edit</button> <button class="btn btn-danger btn-hapus" data="'+item.id+'">hapus</button></td>';
                data+='</tr>';
            });
 
            //memasukan ke element HTML
            $('#tempat_data').html(data);
        }
    });
}
 
//inisialisasi fungsi
tampil_data();

//function untuk bersihkan form 
function bersih() {
    $('#id').val('');
    $('#nama').val('');
    $('#alamat').val('');
    $('#gender').val('');
    $('#gaji').val('');
}

//simpan
$('#save').click(function(){
  //ambil nilai dari form
  let id=$('#id').val();
  let nama=$('#nama').val();
  let alamat=$('#alamat').val();
  let gender=$('#gender').val();
  let gaji=$('#gaji').val();

  //untuk simpan ke Rest API
  $.ajax({
      method: 'POST',
      url: 'http://localhost/restserver/pengurus',
      data: 'id='+id+'&nama='+nama+'&alamat='+alamat+'&gender='+gender+'&gaji='+gaji,
      success: function(result) {
        tampil_data();
        bersih();
      }
  });
});

//untuk menampilkan data yang akan diedit
$(document).on('click', '.btn-edit', function() {
  let id=$(this).attr('data');
  //panggil rest api server dan filter data
  $.ajax({
    method: 'GET',
    url: 'http://localhost/restserver/pengurus',
    data: 'id='+id,
    success: function(result) {
      $('#idEdit').val(result.data[0].id);
      $('#namaEdit').val(result.data[0].nama);
      $('#alamatEdit').val(result.data[0].alamat);
      $('#genderEdit').val(result.data[0].gender);
      $('#gajiEdit').val(result.data[0].gaji);
    }
  });
});

//update data
$('#update').click(function(){
  //hasil form Edit data
  let id=$('#idEdit').val();
  let nama=$('#namaEdit').val();
  let alamat=$('#alamatEdit').val();
  let gender=$('#genderEdit').val();
  let gaji=$('#gajiEdit').val();

  //request ke API Server untuk PUT
  $.ajax({
      method: 'PUT',
      url: 'http://localhost/restserver/pengurus',
      data: 'id='+id+'&nama='+nama+'&alamat='+alamat+'&gender='+gender+'&gaji='+gaji,
      success: function(result) {
        tampil_data();
      }
  });
});

//untuk hapus data
$(document).on('click', '.btn-hapus', function(){
  let id=$(this).attr('data');
  //request ke api server untuk delete
  $.ajax({
    method: 'DELETE',
    url: 'http://localhost/restserver/pengurus',
    data:'id='+id,
    success: function(result) {
      tampil_data();
    }
  });
});

