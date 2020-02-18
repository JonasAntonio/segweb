@extends('templates.template')
@section('content')
    <div class="row">
        @if(!empty($file))
        <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Arquivos analisados</h1>
                    </div>
                    <div class="card-title text-center">
                        <h4>{{$file->original_file_name}}</h4>
                    </div>
                    <div class="card-body">
                        <pre>
                            <code style="color: black !important;">
                                <table class="code-border w100">
                                    <tbody>
                                        @foreach($file_content as $line_number => $line_content)
                                        @php
                                        $color = 'green';
                                        foreach($file_results as $key => $file_result) {
                                            if($file_result->line_number == $line_number) {
                                                $color = $file_result->color;
                                            }
                                        }
                                        @endphp
                                        <tr class="unselectable" id="line-{{$line_number}}">
                                            <td class="pure-{{$color}} key-style">{{($line_number). " - "}}</td>
                                            <td class="pastel-{{$color}}">{{$line_content}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Resultados</h1>
                    </div>
                    <div class="card-body">
                        @if(!empty($file_results)) 
                            <div class="list-group-flush">
                                @foreach ($file_results as $results)
                                    <div class="list-group-item list-group-item-action line_result" id="line_result-{{$results->line_number}}">
                                        <div class="w-100">
                                            <h5 class="mb-1">Linha: {{$results->line_number}}</h5>
                                            <br>
                                            <p><span class="mb-1">Tipo do erro: </span><a href="">{{$results->term_type}}</a></p>
                                            <p class="mb-1">Erro: <span>{{$results->term}}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="btn_scroll" class="btn btn-default">
            <i class="fa fa-chevron-up" aria-hidden="true"></i>
        </button>
        @endif
    </div>
    <div class="row mt-2">
        <div class="container">
            <form action="/" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>
                                @if(empty($file_content))
                                    Enviar arquivos
                                @else
                                    Enviar novos arquivos
                                @endif
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <input type="file" name="file" id="file" class="form-control-file" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Enviar <i class="fa fa-upload" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection