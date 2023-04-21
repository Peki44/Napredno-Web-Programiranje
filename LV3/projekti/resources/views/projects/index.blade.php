@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dodaj novi projekt
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Project Form -->
                    <form action="{{ url('project') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="project-name" class="col-sm-3 control-label">Naziv projekta</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="project-name" class="form-control" value="{{ old('project') }}">
                            </div>

                        </div>

                        <!-- Project Description -->
                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Opis</label>
                            <div class="col-sm-6">
                                <input type="text" name="description" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        <!-- Project Description -->
                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Cijena</label>
                            <div class="col-sm-6">
                                <input type="text" name="price" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        <!-- Project Description -->
                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Obavljeni poslovi</label>
                            <div class="col-sm-6">
                                <input type="text" name="jobs" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Datum pocetka</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_date" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Datum zavrsetka</label>
                            <div class="col-sm-6">
                                <input type="text" name="end_date" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="project-description" class="col-sm-3 control-label">Clanovi tima</label>
                            <div class="col-sm-6">
                                <input type="text" name="members" id="project-description" class="form-control" value="{{ old('project') }}">
                            </div>
                        </div>

                        {{-- @if (count($users) > 0)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Registrirani korisnici:
                                </div>
                                @foreach ($users as $user)
                                    <p>{{ $user->name }}</p>
                                @endforeach
                            </div>
                        @endif --}}

                        <!-- Add Project Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>Dodaj projekt
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Projects -->
            @if (count($projects) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Moji projekti
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped project-table">
                            <thead>
                                <th>Naziv projekta</th>
                                <th>Opis</th>
                                <th>Cijena</th>
                                <th>Obavljeni poslovi</th>
                                <th>Clanovi</th>
                                <th>Datum pocetka</th>
                                <th>Datum zavrsetka</th>
                                <th>Uredi</th>
                                <th>Obriši</th>
                            </thead>
                            <tbody>
                                {{-- @foreach ($projects as $project)
                                    <tr>
                                        <td class="table-text"><div>{{ $project->name }}</div></td>
                                        <td class="table-text"><div>{{ $project->description }}</div></td>
                                        <td class="table-text"><div>{{ $project->price }}</div></td>
                                        <td class="table-text"><div>{{ $project->jobs }}</div></td>
                                        <td class="table-text"><div>{{ $project->members }}</div></td>
                                        <td class="table-text"><div>{{ $project->start_date }}</div></td>
                                        <td class="table-text"><div>{{ $project->end_date }}</div></td>

                                        <td>
                                            <!-- Project Edit Button -->
                      											<form action="{{url('project/edit/' . $project->id)}}" method="GET" style="display: inline-block;">
                      												{{ csrf_field() }}
                      												<button type="submit" id="delete-project-{{ $project->id }}" class="btn btn-success">
                      													<i class="fa fa-btn fa-edit"></i>Uredi
                      												</button>
                      											</form>
                                        </td>
                                         <!-- Project Delete Button -->
                                        <td>
                                            <form action="{{url('project/' . $project->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-project-{{ $project->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Obriši
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}

                                @foreach ($projects as $project)
                                    @if ($project->user_id === $user->id)
                                        <tr>
                                            <td class="table-text"><div>{{ $project->name }}</div></td>
                                            <td class="table-text"><div>{{ $project->description }}</div></td>
                                            <td class="table-text"><div>{{ $project->price }}</div></td>
                                            <td class="table-text"><div>{{ $project->jobs }}</div></td>
                                            <td class="table-text"><div>{{ $project->members }}</div></td>
                                            <td class="table-text"><div>{{ $project->start_date }}</div></td>
                                            <td class="table-text"><div>{{ $project->end_date }}</div></td>

                                            <td>
                                                <!-- Project Edit Button -->
                                                <form action="{{url('project/edit/' . $project->id)}}" method="GET" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    <button type="submit" id="delete-project-{{ $project->id }}" class="btn btn-success">
                                                        <i class="fa fa-btn fa-edit"></i>Uredi
                                                    </button>
                                                </form>
                                            </td>
                                            <!-- Project Delete Button -->
                                            <td>
                                                <form action="{{url('project/' . $project->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-project-{{ $project->id }}" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Obriši
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="panel-heading">
                        Projekti na kojima sudjelujem
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped project-table">
                            <thead>
                                <th>Naziv projekta</th>
                                <th>Opis</th>
                                <th>Cijena</th>
                                <th>Obavljeni poslovi</th>
                                <th>Clanovi</th>
                                <th>Datum pocetka</th>
                                <th>Datum zavrsetka</th>
                                <th>Uredi</th>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    @if (strpos($project->members, $user->name) !== false)
                                        <tr>
                                            <td class="table-text"><div>{{ $project->name }}</div></td>
                                            <td class="table-text"><div>{{ $project->description }}</div></td>
                                            <td class="table-text"><div>{{ $project->price }}</div></td>
                                            <td class="table-text"><div>{{ $project->jobs }}</div></td>
                                            <td class="table-text"><div>{{ $project->members }}</div></td>
                                            <td class="table-text"><div>{{ $project->start_date }}</div></td>
                                            <td class="table-text"><div>{{ $project->end_date }}</div></td>

                                            <td>
                                                <!-- Project Edit Button -->
                                                <form action="{{url('project/editMember/' . $project->id)}}" method="GET" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    <button type="submit" id="delete-project-{{ $project->id }}" class="btn btn-success">
                                                        <i class="fa fa-btn fa-edit"></i>Uredi kao član
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
