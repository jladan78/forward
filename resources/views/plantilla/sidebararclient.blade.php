<div class="sidebar">
            <nav class="sidebar-nav">
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
                        </ul>
                    </li>

                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon icon-book-open"></i> Help <span class="badge badge-danger">PDF</span></a>
                    </li>

                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>