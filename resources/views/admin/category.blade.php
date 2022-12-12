@extends('layouts.admin_template')

@section('content')
    <div class="add-category-page">
        <div class="add-category-form-box">
                @include('common.errors')
                <form action="{{route('admin.category.store')}}" method="POST" class="add-category-form">
                    {{ csrf_field() }}

                    <div class="add-category-field-group">
                        <label for="category" class="">Название категории:</label>


                            <input type="text" name="name" id="category" class="" value="{{old('name')}}">

                        <button type="submit" class="">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Добавить категорию
                        </button>
                    </div>
                </form>

        </div>

        <div class="categoryes-table-box">
            @if (count($categories) > 0)

                        <table class="category-table">
                            <thead>
                            <tr>
                                <th>Название категории</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="tabble-category-name">
                                        <div>{{ $category->name }}</div>
                                    </td>
                                    <td>
                                        <div class="add-edit-form-btn">
                                            <form class="add-edit-category-form" action="{{ route('admin.category.edit', $category->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('GET') }}

                                                <button type="submit" class="">
                                                    <i class="fa fa-btn fa-pencil fa-fw"></i>
                                                </button>
                                            </form>
                                            <form class="add-edit-category-form" action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="">
                                                    <i class="fa fa-btn fa-trash fa-fw"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                <div>
                    * нельзя удалить категорию если в ней имеются объявления
                </div>
            @else
                Здесь пока ничего нет
            @endif
        </div>

    </div>


@endsection
