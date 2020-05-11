@extends('templates.template')
@section('content')
@php
    use SegWeb\Http\Controllers\Tools;
    if(isset($term)) {
        $term_name = $term->term;
        $term_type_id = $term->term_type_id;
        $id = $term->id;
    } else {
        $term_name = NULL;
        $term_type_id = NULL;
        $id = NULL;
    }
@endphp
<div class="row mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/terms" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Cadastro de Termos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="term_type">Termo:</label><input type="text" name="term" class="form-control" value="{{$term_name}}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="color">Categoria:</label>
                                            <select name="term_type" id="term_type" class="form-control" required>
                                                <option value="">---Selecione---</option>
                                                @if (!empty($term_types))
                                                    @foreach ($term_types as $term_type)
                                                        <option value="{{$term_type->id}}" @if($term_type->id == $term_type_id) selected @endif>{{$term_type->term_type}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                @if(!empty($id))
                                    <button type="submit" class="btn btn-primary pull-right">Salvar <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                @else
                                    <button type="submit" class="btn btn-primary pull-right">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Termos Cadastrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table">
                                @if (!empty($terms))
                                    <table id="table_terms" class="table table-hover table-bordered addDataTable">
                                        <thead>
                                            <tr>
                                                <th>Termo</th>
                                                <th>Cor</th>
                                                <th>Data de Envio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($terms as $term)
                                            <tr class="clickable" onclick="document.location='/terms/{{$term->id}}'">
                                                <td>{{$term->term}}</td>
                                                <td>{{$term->term_type}}</td>
                                                <td>{{Tools::db_to_date_time($term->created_at)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    Nenhum tipo de termo encontrado!
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    unset($term);
    unset($color);
    unset($id);
@endphp
@endsection