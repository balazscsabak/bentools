<x-admin-layout>

    <div class="container mt-3 mb-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                {{ $message }}
            </div>
        @endif

        <h2 class="mb-3">Kiemelt kategóriák</h2>

        <div>
            <a class="btn btn-primary btn-sm mb-3" id="feat-cat-add-new-btn">Új kiement kategória </a>
        </div>

        <div class="admin-categories">
        
            <div id="default-new-feat-items" class="d-none">
                <div class="featured-cat-item mb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="name" class="form-label">Szöveg</label>
                            </div>
                            
                        </div>
                        <input type="text" class="form-control fct-text" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Képek</label>
                        <input type="text" class="form-control fct-img" name="image">
                    </div>
                    <label for="name" class="form-label">Kategóriák</label>
                    <select class="form-select fct-categories" size="8" multiple aria-label="multiple select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <div class="mt-4">
                        <div class="text-end text-danger feat-cat-delete-item">
                                Törlés
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.categories.featured.update') }}" id="feat-cat-update-form">
                @csrf

                <div id="feat-cat-form">
                    @foreach ($featured as $fc)
                        <div class="featured-cat-item mb-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <label for="name" class="form-label">Szöveg</label>
                                    </div>
                                    
                                </div>
                                <input type="text" class="form-control fct-text" name="name" value="{{ $fc->text }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Képek </label>
                                <input type="text" class="form-control fct-img" name="image" value="{{ $fc->img }}">
                            </div>
                            <label for="name" class="form-label">Kategóriák</label>
                            <select class="form-select fct-categories" size="8" multiple aria-label="multiple select">
                                @foreach ($categories as $category)
                                    @if(in_array($category->id, $fc->categories))    
                                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <div class="mt-4">
                                <div class="text-end text-danger feat-cat-delete-item">
                                        Törlés
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="submit" value="Mentés" class="btn btn-primary">
            </form>
        
        </div>

    </div>

</x-admin-layout>