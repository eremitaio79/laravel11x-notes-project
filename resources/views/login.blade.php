@extends('layouts.main')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card p-5">

                <!-- logo -->
                <div class="text-center p-3">
                    <img src="assets/images/logo.png" alt="Notes logo">
                </div>

                <!-- form -->
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <form action="/login-submit" method="post" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="text_username" class="form-label">Username</label>
                                <input type="email" class="form-control bg-dark text-info"
                                    name="text_username"
                                    value="{{ old('text_username') }}"
                                    required>
                                {{-- show error --}}
                                @error('text_username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text_password" class="form-label">Password</label>
                                <input type="password" class="form-control bg-dark text-info"
                                    name="text_password"
                                    value="{{ old('text_password') }}"
                                    required>
                                {{-- show error --}}
                                @error('text_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary w-100">
                                    LOGIN
                                </button>
                            </div>
                        </form>

                        {{-- invalid login --}}
                        @if(session('loginError'))
                        <div id="alertaErro" class="alert alert-danger text-center p-1 position-relative">
                            {{ session('loginError') }}
                            <div class="progress mt-1"
                                style="height: 2px; background-color: rgba(255, 255, 255, 0.3);">
                                <div id="barraProgresso"
                                    class="progress-bar bg-dark"
                                    role="progressbar"
                                    style="width: 0%;"
                                    aria-valuenow="0"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let alerta = document.getElementById("alertaErro");
                                let barra = document.getElementById("barraProgresso");
                                let duracao = 3000; // 3 segundos para fechar o alert.
                                let interval = 100; // Atualiza a cada 100ms

                                let largura = 0; // Inicia em 0%
                                let incremento = (interval / duracao) * 100;

                                let animacao = setInterval(() => {
                                    largura += incremento;
                                    barra.style.width = largura + "%";

                                    if (largura >= 100) {
                                        clearInterval(animacao);
                                        alerta.style.transition = "opacity 1s";
                                        alerta.style.opacity = "0";
                                        setTimeout(() => alerta.remove(), 1000);
                                    }
                                }, interval);
                            });
                        </script>
                        @endif


                        {{-- success logout --}}
                        @if(session('logoutSuccess'))
                        <div id="alertaSucesso" class="alert alert-success text-center p-1 position-relative">
                            {{ session('logoutSuccess') }}
                            <div class="progress mt-1"
                                style="height: 2px; background-color: rgba(255, 255, 255, 0.3);">
                                <div id="barraProgresso"
                                    class="progress-bar bg-dark"
                                    role="progressbar"
                                    style="width: 0%;"
                                    aria-valuenow="0"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let alerta = document.getElementById("alertaSucesso");
                                let barra = document.getElementById("barraProgresso");
                                let duracao = 3000; // 3 segundos para fechar o alert.
                                let interval = 100; // Atualiza a cada 100ms

                                let largura = 0; // Inicia em 0%
                                let incremento = (interval / duracao) * 100;

                                let animacao = setInterval(() => {
                                    largura += incremento;
                                    barra.style.width = largura + "%";

                                    if (largura >= 100) {
                                        clearInterval(animacao);
                                        alerta.style.transition = "opacity 1s";
                                        alerta.style.opacity = "0";
                                        setTimeout(() => alerta.remove(), 1000);
                                    }
                                }, interval);
                            });
                        </script>
                        @endif

                    </div>
                </div>

                <!-- copy -->
                <div class="text-center text-secondary mt-3">
                    <small>&copy; <?= date('Y') ?> Notes</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
