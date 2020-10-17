<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,500&display=swap" rel="stylesheet">
  <title>Nofaro - teste de api e form de uso</title>
  <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('site/datatables.css') }}">
  <link rel="stylesheet" href="{{ asset('site/jquery-confirm.css') }}">
  <link rel="stylesheet" href="{{ asset('site/styles.css') }}">
</head>
<body>

<section class="form">
  <div class="container">
    <div class="col-md-12 col-lg-12 col-sm-12 text-center nav-center">
      <img class="logoimg" src="{{ asset('site/img/logo_nofaro-color.svg') }}" alt="nofaro">
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 text-center">
      <ul class="nav justify-content-center menu">
        <li class="nav-item">
          <a class="nav-link active" id="listapets" href="#">Listar Pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="addpets" href="#">Adicionar Pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="listaconsultas" href="#">Listar Consultas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="addconsultas" href="#">Agendar Consulta</a>
        </li>
      </ul>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 text-center listapets">
      <table id="table_pets_lista" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome Pet</th>
                <th>Espécie</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- data -->
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 text-center addpets">
      <!-- form add pets -->
      <form class="needs-validation" novalidate id="savePet">
        <div class="form-group">
          <label for="formGroupExampleInput">Nome do pet</label>
          <input type="text" pattern=".{2,}" required class="form-control" name="name_pet" id="name_pet">
          <div class="invalid-feedback">
            Insira 2 ou mais caracteres no nome do Pet!
          </div>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Espécie</label>
          <select class="form-control" name="id_specie" id="id_specie">
            <option value="1">Cachorro</option>
            <option value="2">Gato</option>
          </select>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
      </form>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 text-center listaconsultas">
      <table id="table_consultas_lista" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Pet</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- data -->
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 text-center addconsultas">
      <form class="needs-validation" novalidate id="saveAttendance">
        <div class="form-group">
          <label for="formGroupExampleInput">Data da Consulta</label>
          <input type="text" pattern=".{10,}" required class="form-control" name="date_attendance" id="date_attendance">
          <div class="invalid-feedback">
            Insira uma data para a consulta no formato 'AAAA-MM-DD'!
          </div>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Pet</label>
          <select class="form-control" name="id_pet" id="id_pet">
            
          </select>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Descrição da Consulta</label>
          <textarea type="text" class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</section>

<footer class="text-center">
  <h5>Nofaro 2020 - Sistema de inserção e listagem de pets com api.</h5>
</footer>
  
<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('site/bootstrap.js') }}"></script>
<script src="{{ asset('site/datatables.js') }}"></script>
<script src="{{ asset('site/jquery-confirm.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script>
  //função pronta para validação para mostrar os erros do form
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  $(document).ready(function () {
    //máscara simples para data
    $("#date_attendance").mask("9999-99-99");

    //toggle rápido dos 4 menus
    $('#listapets').click(function() {
      $('.listapets').show(200);
      $('.addpets').hide();
      $('.listaconsultas').hide();
      $('.addconsultas').hide();
    });
    $('#addpets').click(function() {
      $('.listapets').hide();
      $('.addpets').show(200);
      $('.listaconsultas').hide();
      $('.addconsultas').hide();
    });
    $('#listaconsultas').click(function() {
      $('.listapets').hide();
      $('.addpets').hide();
      $('.listaconsultas').show(200);
      $('.addconsultas').hide();
    });

    //nesse menu ele lê de forma externa os pets cadastrados e joga no select.
    $('#addconsultas').click(function() {
      var getPets = [];
      $.ajax({
        url : './api/pets',
        dataSrc: '',
        type: 'get',
        dataType: 'json',
          success: function(data) {
              $('#id_pet').html();
              $.each( data, function( val, key ) {
                getPets.push( "<option value='"+key.id+"'>"+key.name_pet+"</option>" );
              });
              $('#id_pet').html(getPets);
          }
      });
      $('.listapets').hide();
      $('.addpets').hide();
      $('.listaconsultas').hide();
      $('.addconsultas').show(200);
      
    });

    //inicia as duas tabelas de listagem
    listadatapets();
    listadataconsultas();
    

  });

  

  $("#savePet").on("submit",function (e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax(
    {
        type:'post',
        url:'./api/pets/',
        data:formData,
        success:function(result)
        {
          $('form#savePet #name_pet').val('');
          $.alert('Pet inserido com sucesso!');
          $('#table_pets_lista').DataTable().destroy();
          listadatapets();
        },
        error:function(result)
        {
          $.alert('Erro ao inserir pet, tente novamente!');
        }
    });
  });

  $("#saveAttendance").on("submit",function (e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax(
    {
        type:'post',
        url:'./api/attendances/',
        data:formData,
        success:function(result)
        {
          $('form#saveAttendance #date_attendance').val('');
          $('form#saveAttendance #description').val('');
          $('#table_consultas_lista').DataTable().destroy();
          listadataconsultas();
          $.alert('Consulta agendada com sucesso!');
        },
        error:function(result)
        {
          $.alert('Erro ao inserir consulta, tente novamente!');
        }
    });
  });

  function deletar(id){
    $.confirm({
      title: 'Deseja apagar o pet?',
      content: 'Todas as consultas relacionadas serão apagadas também.',
      buttons: {
          confirma: function () {
            text:'Deletar',
            $.ajax({
              url: "./api/pets/"+id,
              type: 'delete',
              cache: false,
              data:{
                _token:'{{ csrf_token() }}'
              },
              success: function (response) {
                $.alert('Pet removido do sistema!');
                $('#table_pets_lista').DataTable().destroy();
                listadatapets();
                $('#table_consultas_lista').DataTable().destroy();
                listadataconsultas();
              }
            });
          },
          cancela: {
            text: 'Cancelar'
          }
      }
    });    
  };

  function deletarconsulta(id){
    $.confirm({
      title: 'Deseja apagar a consulta?',
      content: 'A descrição e data da consulta será apagado.',
      buttons: {
          confirma: function () {
            text:'Deletar',
            $.ajax({
              url: "./api/attendances/"+id,
              type: 'delete',
              cache: false,
              data:{
                _token:'{{ csrf_token() }}'
              },
              success: function (response) {
                $.alert('Consulta removida do sistema!');
                $('#table_consultas_lista').DataTable().destroy();
                listadataconsultas();
              }
            });
          },
          cancela: {
            text: 'Cancelar'
          }
      }
    });    
  };

  
  
  function listadatapets(){
      $('#table_pets_lista').dataTable({
        "autoWidth": false,
        "language" : {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "0": "Nenhuma linha selecionada",
                  "1": "Selecionado 1 linha"
              }
          },
          "buttons": {
              "copy": "Copiar para a área de transferência",
              "copyTitle": "Cópia bem sucedida",
              "copySuccess": {
                  "1": "Uma linha copiada com sucesso",
                  "_": "%d linhas copiadas com sucesso"
              }
          }
        },
        ajax: {
          url : './api/pets',
          dataSrc: '',
          type: 'get',
          dataType: 'json',
        },
        columns: [
          { data: 'id' },
          { data: 'name_pet' },
          { data: 'id_specie', render: function(data) {
                var especie = '';

                switch (data) {
                    case '1':
                        especie = 'Cachorro';
                        break;
                    case '2':
                        especie = 'Gato';
                        break;
                }
                return '<span">' + especie + '</span> ';
            }
          },
          { data: 'id', render: function(data) {
                return '<a href="javascript:deletar('+data+')" class="deletarPet">Deletar</a> ';
            }}
        ]}
      );
    }

    function listadataconsultas(){
      $('#table_consultas_lista').dataTable({
        "autoWidth": false,
        "language" : {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "0": "Nenhuma linha selecionada",
                  "1": "Selecionado 1 linha"
              }
          },
          "buttons": {
              "copy": "Copiar para a área de transferência",
              "copyTitle": "Cópia bem sucedida",
              "copySuccess": {
                  "1": "Uma linha copiada com sucesso",
                  "_": "%d linhas copiadas com sucesso"
              }
          }
        },
        ajax: {
          url : './api/attendances',
          dataSrc: '',
          type: 'get',
          dataType: 'json',
        },
        columns: [
          { data: 'id' },
          { data: 'date_attendance' },
          { data: 'id_pet' },
          { data: 'description' },
          { data: 'id', render: function(data) {
                return '<a href="javascript:deletarconsulta('+data+')" class="deletar">Deletar</a> ';
            }}
        ]}
      );
    }


</script>

</body>
</html>