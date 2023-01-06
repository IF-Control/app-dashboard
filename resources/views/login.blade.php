@include('/components/header')

<section id="login-page">
    <div class="row row-full">
        <div class="col-12 col-lg-6">
            <h2 class="title-ifcontrol">IF Control</h2>
            <div class="form-box">
                <div class="form-login">
                    <h2 class="form-title">Entrar</h2>
                    <div class="green-line"></div>

                    @include('/components/alerts')
                    @include('/components/validate-errors')

                    <form action="{{ route('enter') }}" method="post" name="login-form" id="login-form">
                        @csrf
                        <div class="form-group mt-3">
                            <label class="form-label">Login</label>
                            <input type="email" name="email" id="email" class="form-control" minlength="6" maxlength="52" placeholder="E-mail" required />
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="passwd" id="passwd" class="form-control" minlength="6" maxlength="20" placeholder="Senha" required /><br/>
                        </div>
                        <button type="submit" class="btn btn-pill btn-primary w-25 align-center mt-1">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6" id="bg-login">
        </div>
    </div>
</section>
