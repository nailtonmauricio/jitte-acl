@extends('templates.install.index')
@section('content')
    <div class="container-fluid mt-3 col-6">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-requirements-tab" data-bs-toggle="tab" data-bs-target="#nav-requirements" type="button" role="tab" aria-controls="nav-requirements" aria-selected="false">Requisitos</button>
                <button class="nav-link" id="nav-terms-tab" data-bs-toggle="tab" data-bs-target="#nav-terms" type="button" role="tab" aria-controls="nav-terms" aria-selected="false">Termos</button>
                <button class="nav-link" id="nav-sgdb-tab" data-bs-toggle="tab" data-bs-target="#nav-sgdb" type="button" role="tab" aria-controls="nav-sgdb" aria-selected="true">Base de Dados</button>
                <button class="nav-link" id="nav-dbconfig-tab" data-bs-toggle="tab" data-bs-target="#nav-dbconfig" type="button" role="tab" aria-controls="nav-dbconfig" aria-selected="false">Configuração DB</button>
                <button class="nav-link" id="nav-cmsconfig-tab" data-bs-toggle="tab" data-bs-target="#nav-cmsconfig" type="button" role="tab" aria-controls="nav-cmsconfig" aria-selected="false">Configuração CMS</button>
                <button class="nav-link" id="nav-install-tab" data-bs-toggle="tab" data-bs-target="#nav-install" type="button" role="tab" aria-controls="nav-install" aria-selected="false">Instalar CMS</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-requirements" role="tabpanel" aria-labelledby="nav-requirements-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Requerimentos mínimos para instalação do projeto
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary"><span class="fas fa-angle-double-left"></span> Anterior</button>
                        <button type="submit" class="btn btn-secondary" id="showRequirements" name="showRequirements">Próximo <span class="fas fa-angle-double-right"></span></button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="pt-2">
                            <h1 class="display-6 fw-bold">Requisitos Mínimos</h1>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Versão requerida</th>
                                    <th scope="col">Versão instalada</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>PHP</td>
                                    <td>8.0.26</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>PDO</td>
                                    <td>3.33.0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>PDO MySQL</td>
                                    <td>3.33.0</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="pt-5">
                            <h1 class="display-6 fw-bold">Permissões Requeridas</h1>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" colspan="2">Arquivo / Diretório</th>
                                    <th scope="col">Permissão obtida</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Configuração do JITTE</td>
                                    <td>C:\Users\Família\AppData\Local\Temp</td>
                                    <td>Escrita</td>
                                </tr>
                                <tr>
                                    <td>Diretório temporário</td>
                                    <td>C:\Users\Família\AppData\Local\Temp</td>
                                    <td>Escrita</td>
                                </tr>
                                <tr>
                                    <td>Session Save Path</td>
                                    <td>C:\Users\Família\AppData\Local\Temp</td>
                                    <td>Escrita</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="pt-5">
                            <h1 class="display-6 fw-bold">Informações de Ambiente</h1>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" colspan="2">Info</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Sistema Operacional</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Banco de dados escolhido</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Server API</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Timezone</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>PHP Info</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end text-secondary">Jitte </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="nav-terms" role="tabpanel" aria-labelledby="nav-terms-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Termos de utilização
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary"><span class="fas fa-angle-double-left"></span> Anterior</button>
                        <button type="submit" class="btn btn-secondary">Próximo <span class="fas fa-angle-double-right"></span></button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="py-2">
                            <h1 class="display-6 fw-bold">Termos de serviço</h1>
                        </div>
                        <div class="border border-secondary p-2 mb-2">
                            <h5>The MIT Licence (MIT)</h5>
                            <p>Copyright (c) https://jitte.com.br</p>

                            <p>Copyright Permission is hereby granted, free of charge, to any person obtaining a copy of this
                                software and associated documentation files (the “Software”), to deal in the Software without restriction,
                                including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
                                sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
                                subject to the following conditions:</p> <p>The above copyright notice and this permission notice shall
                                be included in all copies or substantial portions of the Software.</p> <p><strong>THE SOFTWARE IS PROVIDED “AS IS”,
                                    WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
                                    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                                    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
                                    AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
                                    OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</strong></p>
                        </div>
                        <form name="serviceTerms" method="post" action="#">
                            <div class="mb-3 form-check d-flex justify-content-center align-items-center">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                <label class="form-check-label ms-1" for="terms">Li e concordo com os termos da licença</label>
                            </div>
                        </form>

                        <div class="text-end text-secondary">Jitte v1.0.0</div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="nav-sgdb" role="tabpanel" aria-labelledby="nav-sgdb-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Seleção do SGDB
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary" id="sendDB" name="sendDB">Próximo <span class="fas fa-angle-double-right"></span></button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="py-2">
                            <h1 class="display-6 fw-bold">Jitte CMS</h1>
                            <p class="col-md-8 fs-4">Bem vindo à instalação do JITTE CMS Versão , uma ferramenta desenvolvida especialmente para você.</p>
                            <p class="col-md-8 fs-4">Selecione o SGDB de sua preferência, as demais etapas da instalação levarão em conta essa configuração.</p>
                        </div>
                        <div class="text-end text-secondary">Jitte </div>
                    </div>
                    <form name="db-select" method="post" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mt-2 p-3 bg-light rounded-3">
                                    <input class="form-check-input ms-2" type="radio" name="db-driver" id="mysql-mariadb">
                                    <label class="form-check-label" for="mysql-mariadb">
                                        <span class="fas fa-database display-5 ms-2 "></span>
                                        MySQL/MariaDB
                                    </label>
                                </div>
                                <div class="form-check mt-2 p-3 bg-light rounded-3">
                                    <input class="form-check-input ms-2" type="radio" name="db-driver" id="postgresql" disabled>
                                    <label class="form-check-label" for="postgresql">
                                        <span class="fas fa-database display-5 ms-2 "></span>
                                        PostgreSQL
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-2 p-3 bg-light rounded-3">
                                    <input class="form-check-input ms-2" type="radio" name="db-driver" id="sqlite" disabled>
                                    <label class="form-check-label" for="sqlite">
                                        <span class="fas fa-database display-5 ms-2 "></span>
                                        SQLite
                                    </label>
                                </div>
                                <div class="form-check mt-2 p-3 bg-light rounded-3">
                                    <input class="form-check-input ms-2" type="radio" name="db-driver" id="mongodb" disabled>
                                    <label class="form-check-label" for="mongodb">
                                        <span class="fas fa-database display-5 ms-2 "></span>
                                        MongoDB
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="tab-pane fade show" id="nav-dbconfig" role="tabpanel" aria-labelledby="nav-dbconfig-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Configuração da base de dados
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary"><span class="fas fa-angle-double-left"></span> Anterior</button>
                        <button type="submit" class="btn btn-secondary">Próximo <span class="fas fa-angle-double-right"></span></button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="alert alert-primary" role="alert">
                            <strong>Atenção: </strong>O banco de dados especificado precisa existir. A aplicação procurará por versões
                            anteriores para atualizar o banco. Caso não exista uma versão, ou não queira atualizar, certifique-se que o banco esteja vazio.
                        </div>
                        <div class="py-2">
                            <h1 class="display-6 fw-bold">Banco de Dados</h1>
                            <h6>Tipo: <span class="text-decoration-underline">MySQL/MariaDB</span></h6>
                        </div>
                        <form name="dataBaseConfiguration" method="post" action="#">
                            <div class="mb-3">
                                <label for="host" class="form-label">Host</label>
                                <input type="text" class="form-control" id="host" name="host" aria-describedby="hostHelp">
                                <div id="hostHelp" class="form-text">Nome ou IP do host.</div>
                            </div>
                            <div class="mb-3">
                                <label for="port" class="form-label">Porta</label>
                                <input type="text" class="form-control" id="port" name="port" aria-describedby="portHelp" pattern="[\d]*">
                                <div id="portHelp" class="form-text">Porta de serviço padrão.</div>
                            </div>
                            <div class="mb-3">
                                <label for="db-user" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="db-user" name="db-user" aria-describedby="db-userHelp">
                                <div id="db-userHelp" class="form-text">Nome de usuário para o banco de dados.</div>
                            </div>
                            <div class="mb-3">
                                <label for="db-password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="db-password" name="db-pass" aria-describedby="db-passwordHelp">
                                <div id="db-passwordHelp" class="form-text">Senha de acesso ao banco de dados.</div>
                            </div>
                            <div class="mb-3">
                                <label for="db" class="form-label">Base de dados</label>
                                <input type="text" class="form-control" id="db" name="db-name" aria-describedby="dbHelp">
                                <div id="dbHelp" class="form-text">Nome do banco de dados.</div>
                            </div>
                            <div class="mb-3">
                                <label for="charset" class="form-label">Charset</label>
                                <input type="text" class="form-control" id="charset" name="db-charset" aria-describedby="charsetHelp">
                                <div id="charsetHelp" class="form-text">Charset padrão do banco de dados.</div>
                            </div>
                        </form>
                        É necessário testar o banco de dados antes de prosseguir. <button type="submit" class="btn btn-success">Testar</button>

                        <div class="text-end text-secondary">Jitte</div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="nav-cmsconfig" role="tabpanel" aria-labelledby="nav-cmsconfig-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Configuração do usuário adm
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary"><span class="fas fa-angle-double-left"></span> Anterior</button>
                        <button type="submit" class="btn btn-secondary">Próximo <span class="fas fa-angle-double-right"></span></button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="py-2">
                            <h1 class="display-6 fw-bold">Administrador</h1>
                        </div>
                        <form name="cmsConfig" method="post" action="#" autocomplete="off">
                            <div class="mb-3">
                                <label for="first-name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="first-name" name="last-name" aria-describedby="first-nameHelp">
                                <div id="first-nameHelp" class="form-text">Primeiro nome, do administrador do CMS.</div>
                            </div>
                            <div class="mb-3">
                                <label for="last-name" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="last-name" name="last-name" aria-describedby="last-nameHelp">
                                <div id="last-nameHelp" class="form-text">Segundo nome, do administrador do CMS.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Usuário</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">E-mail para login no CMS.</div>
                            </div>
                            <div class="mb-3">
                                <label for="cms-user-password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="cms-user-password" name="password" aria-describedby="cms-passwordHelp">
                                <div id="cms-passwordHelp" class="form-text">Senha de acesso ao CMS.</div>
                            </div>
                        </form>

                        <div class="text-end text-secondary">Jitte </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show" id="nav-install" role="tabpanel" aria-labelledby="nav-install-tab" tabindex="0">
                <!--
                ====================================================================================================================
                Instalação do CMS
                ====================================================================================================================
                -->
                <div class="mt-5">
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-secondary"><span class="fas fa-angle-double-left"></span> Anterior</button>
                    </div>
                    <div class="p-5 mb-4 bg-light rounded-3">
                        <div class="py-2">
                            <h1 class="display-6 fw-bold">Instalar</h1>
                        </div>
                        <div class="py-2">
                            <p class="fw-bold">Clique no botão para iniciar a instalação do sistema.</p>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <strong>Atenção: </strong>Ao clicar em instalar, caso já exista uma instalação do JITTE no banco de dados especificado, o mesmo será atualizado.
                        </div>
                        <button type="button" class="btn btn-success">Instalar</button>

                        <div class="text-end text-secondary">Jitte </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection