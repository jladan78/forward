<div class="sidebar" >
            <nav class="sidebar-nav" >
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="nav-icon icon-speedometer"></i> Dashboard</a>
                    </li>
                    <li class="nav-title">
                        Programme assessments
                    </li>

                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon icon-people"></i> Clients </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-note"></i> MBRP </a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-docs"></i> Questionnaries</a>
                            </li>
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-docs"></i> Data</a>
                            </li>
                        </ul>
                    </li>
<!--   
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-wallet"></i> Compras</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-wallet"></i> Ingresos</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-notebook"></i> Proveedores</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-notebook"></i> Clientes</a>
                            </li>
                        </ul>
                    </li>
 -->
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-people"></i> Access</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-user"></i> Users</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
 
<!--                      <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-chart"></i> Reporte Ingresos</a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="nav-icon icon-chart"></i> Reporte Ventas</a>
                            </li>
                        </ul>
                    </li>
 -->
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon icon-book-open"></i> Help <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon icon-info"></i> About...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>