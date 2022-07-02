<?php defined('ALTUMCODE') || die() ?>
    <section class="wrapper bg-soft-primary pt-10 pb-12 pt-md-8 pb-md-17">
        <div class="container">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 mt-lg-n2 text-center text-lg-start order-2 order-lg-0" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-3 mb-5 mx-md-10 mx-lg-0">Multiple link dengan custom background dan beberapa tombol penting untuk jualan kamu<br />
                    <span class="rotator-fade text-primary display-5">Dapat button animation, Shortener url, Terintegrasi facebook pixel, Terintegrasi Google Analytic, Google Tag Manager untuk cek traffic iklan kamu.</span></h1>
                    <!-- <span class="typer text-primary text-nowrap display-5" data-delay="100" data-words="Dapat button animation, Shortener url, Terintegrasi facebook pixel, Terintegrasi Google Analytic, Google Tag Manager untuk cek traffic iklan kamu."></span><span class="cursor text-primary" data-owner="typer"></span></h1> -->
                    <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                        <span><a href="login" class="btn btn-lg bg-diglink rounded-pill text-white mb-4 me-2">Sign In</a></span>
                        <?php if($_SESSION['user_id'] != '' || $_SESSION['user_id'] != null) {?>
                            <span><a href="logout" class="btn btn-lg btn-danger rounded-pill">logout</a></span>
                        <?php } else { ?>
                            <span><a href="register" class="btn btn-lg btn-danger rounded-pill">Sign Up</a></span>
                        <?php } ?>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-3 offset-1 offset-lg-0 col-lg-4 d-flex flex-column" data-cues="zoomIn" data-group="col-start" data-delay="300">
                            <div class="ms-auto mt-auto"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa20.jpg" srcset="./assets/img/photos/sa20@2x.jpg 2x" alt="" /></div>
                            <div class="ms-auto mt-5 mb-10"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa18.jpg" srcset="./assets/img/photos/sa18@2x.jpg 2x" alt="" /></div>
                        </div>
                        <!-- /column -->
                        <div class="col-4 col-lg-5" data-cue="zoomIn">
                            <div><img class="w-100 img-fluid rounded shadow-lg" src="./assets/img/photos/sa16.jpg" srcset="./assets/img/photos/sa16.jpg" alt="" /></div>
                        </div>
                        <!-- /column -->
                        <div class="col-3 d-flex flex-column" data-cues="zoomIn" data-group="col-end" data-delay="300">
                            <div class="mt-auto"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa21.jpg" srcset="./assets/img/photos/sa21@2x.jpg 2x" alt="" /></div>
                            <div class="mt-5"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa19.jpg" srcset="./assets/img/photos/sa19@2x.jpg 2x" alt="" /></div>
                            <div class="mt-5 mb-10"><img class="img-fluid rounded shadow-lg" src="./assets/img/photos/sa17.jpg" srcset="./assets/img/photos/sa17@2x.jpg 2x" alt="" /></div>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light pt-10 pb-12 pt-md-8 pb-md-17">
        <div class="container">
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                <div class="col-md-8 col-lg-6 position-relative">
                    <a href="./assets/media/movie.mp4" class="btn btn-circle btn-primary btn-play ripple mx-auto mb-5 position-absolute" style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i class="icn-caret-right"></i></a>
                    <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0" style="bottom: -1.8rem; right: -1.5rem; width: 85%; height: 90%; "></div>
                    <figure class="rounded"><img src="./assets/img/photos/about8.jpg" srcset="./assets/img/photos/about8@2x.jpg 2x" alt=""></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5 col-xl-4 offset-lg-1">
                    <h3 class="display-4 mb-7">Features</h3>
                    <div class="d-flex flex-row mb-5">
                        <div>
                            <img src="https://www.i2clipart.com/cliparts/8/7/7/c/clipart-blue-play-button-pressed-down-256x256-877c.png" class="svg-inject icon-svg icon-svg-md text-yellow me-5" alt="" />
                        </div>
                        <div>
                            <h4 class="mb-1">Button Animation</h4>
                            <p class="mb-0">Setting Button Animation Sesuka Hati.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-5">
                        <div>
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAn1BMVEX////eXC3eWirdWSjdVyTeWSndVSHdVB7++/rdUxz+/PvdWCX++ff549399fLhaj377OfcUBX43tbkelb88e376uTfXzHyxLffYzf218321MnvsZ3cTg744Nr43NPjc0vtqpXtpYzpknTibkTkeVP1zcDxvq/rnYLnjHHok3rlgmLywbLwt6XmhWbhakHspo/vsJnpmoTojWzrmXznh2NzgC4VAAATWklEQVR4nNVd6WKqOhCWhEUMKsgiigouuNWlrX3/Z7va5VTLTEiiqPf7eY4FviyzZ1KrVYpG3XHc3ksynnz46TSOIi2Konia+tvDOOmOXMepN6r9gupQD9ywN198tO2BZ1s6owYh2jcIIVQ3LdsbmNOP8XwUuq3/GU/H7fQ3h5nm2Sb9RwsGZabtRf5i3u+4/xeWQa+bLae2rZeR+wWhps3S1XHZth799aVw82w50yydipL7haFbkb9K8uDRHDhodd/WO6Yb8ux+55JMt+PceTQTGL1DGlPxlYmyZCSejTuPZlNAkLRtZlxN75ukodvtzTNtyaB3YLbCzuOytNmi9yQkw+7WNG80exccTX3bbT6aXa3WnPu2fnt6X9Atfz58ML9krbOq+J3ALD95oNRxM1+rlN8JlPpZ+CCCr6l2Y/ECg2lpVn8Av3zK1FW7JAwavdyZXqPzfmv1wAex/d495zFMYvOe/E7Qyf5uqqOeb60K9F8ZiDWb38cqD7OoMgXIB6Wr3h0I5lv9ARP4DSut3FxtZbvKNSAPRjSpdjeG6+vdo+tA2K5bHb9Grj9oB57D8MZVCZxWNnjwBH7D9qtZqc2Vfd2HEUINeoRBCbluqPR2FYGO3lpVxJxio7ZnafE0nc18fzZLp+2I2Z5tSoTjLkHjza1XaiOfqRAkzPLstj/Zb7r9Xm/UGQ6bzeGwMxr1ev3uZn9YT5lnqwTmaPTm3pbhXF5JEGYPtG2WD0M3aEE2ZcNpuWGzvzmkpmfJsiTa+019qlci9wWEWgP2sWkKZSXqTquXzTzPlIpkEZbekOJBSogaTItnr9LirjdOY41JjCSzRzfi1zpICFGia+kyUZTmnWSZauJGIbH6NyEYHMS3ILXay+SakW30kuXOFJ1IGndv4DS6C010UHXdz65POwR55jNB28nYvVxNMRAmqOvbeecmfnh9ON9aYhzp1RQdUYLU2+a3SwA23P56ILRWrzbEx0yIIB3M+je2o5z+zBPhaMT5Na8ZeyL8DOJf9RYMuU8FwnnUvkKizgci/DT/+u0Ow9mIcCSesquRC+xBYs2SG1uI5wj30/KoHp0qUuyl5eOnR28VB4fyVbnFyNZKBlyz3F0i5rpbeY4v2KSl00hWCusoWJUOHdXuEqRtjN7LLDmiZdIj7SSl3qm5y+8UaG9lZd4ViaTVYl6W1iXm+x2T0D1asmVoJGkON8tmkMVJNVwQBOsSwU7bUlvRmfHNQkLXt3FcxNEax3zRbr7L7JmMb8tQbXX/EgJnM+WvVG8j/rA84q4II8oeUZpVz1OuvCGx8LoKfe56INH8QWVZPf4sGmvBrdjYc2fwaOk+rEwyjLkUSSb2mG7MY0jZreI/KnDbPBFI20I+TnPNewhLH1um5Pq8WdS3Al/nJBZvlNaPrsNqrnnixkrKVUavzVmjdP34ssgOzyMgcamr40w4hjx7AoLHOeClUMxlmS3Z5RCk6YPL6L7Rb3MWqllSW1Tf4X9MtOcgeJwGjqgwYr6yfsUD+GRwj1IPMWScAJI15v1lgLsUhFUST1MER1oQkxfSWKB7mGibZzrw0eIobTbB/67D2YX7Jym6/kYnxSdjh1vgY864VBgyVEHjBbct6QoTNqMZ5lMw/xkU4QVaY3S90SkiMhoZ9jckrrAOSRUhbtvob/AkdnyMIeMK4EchR9cpncKKbYPpUd2/87cLYoxOorWHJrGJTSHRymPmThDmm/FhMjmMk5eRG9wlCOCgUQ0yheQGagqZZRGeejMfp96pxumI09FQ4u/74R2ixTlqvdmb4utbW0SHmpOSCRklvmleSGFCLctPRtVzXGEUaVrUbiNkUdMpP2oRJDMw5M70StNuX2iiwsYuSv8FYumZfGutt0SLfKhWfdh4g3kKbP33pw5ic+tLrpjJcePp9JrK9WiIhm0KieE5PBglur5bEmk3SNVnXVCP3Vz8+SUieNkbT1x0S9OzV1ZKlMOdIAKS6Jc/DOEppClvJ/Xi8nIQVlHF8j+g0V3zcmwzeCTI36k+h1uSoPqmOK7W7QqWyE68dBMbcKaCtHkTIFaySMTi0OqYI5NIp+fKqrcDf2XyLG7coPjzkEW1iaoA8TFIND/71Sv8cQPOtznc8PrFmypOdCTIi9nq9zcNeC2bB4XnFmFl1drhLXgBatT/VeU9WFeYHKuLnyG5gDGtOJ86hvcLiX+V8SYCCR449hr8JzC8ipdpiOTk9eznF/U30DBgnAhwsJQ4AWW9Vsuwhni2+vJnETa30IrT3zmLq89Pqf8Zqo+KGebwJNL0Z476U2irclMcXYlFqhGtYoYtJCNIf4zqObTiDG6iaS510pmndW6Bxhj+nB8p3gL/Hw7m/GN4Kb6YbfOcDK/qnM4IXqb698khMG9MIq6x9XLxW227mfM2pj3nPesGcGFZQ3ZfUnwEGXaMn/M/r64l0WkxcNJWx9VSMUMng1Wi9TVNOWRB63vuI1urf+KX0LdP7wFz1DTAG705+vAK+gq5gcUX5/YAiN5P+IKaiy+tg0QJPoeLk++6DZBgr344DX4ADT4tdVz7qU0J0b1/pzn7eLWf/l41wxZstNDZafTdGUD/3C5HEGZ+O33fDH9MuyGeea5c5SMaTyPkJExD0IQWqI+tt1ot59d0DTkMt9VR+wZstXyZxD1gdZGdvAYLcIbVr1LE8vzSU1BQ1Ujlk/YBbubcgWED3ojmolGrQ8FutpR/R4AXYlcvSzGPnH3Ua/UPYHp1iYLiHwR4Yv0eDLugp0+nTs2ZAqLUUjAkA+hB3wx54ZAboQMXIVhHhtD6tRUSYy3cMr0HwxYsagYuKAJJW+UVaBnAHay2I1Ygw6O6gBwPJdnXwktb78JwD77a7ta6gLJQCqwgy+ST4T1qOeDYmLUBKzA8lUB86x11Lu7CEC4+Ob56D0iagUq+yDngDPmu2G3QAdXFUchB3zVQCVI7WJ78Dh7wCbC2ou+19+K/k0il0JLHsOqA6SfAQ73kowZIQBWr9MgQCXjdjSGYISQzKF5MP5QYZihD+y5nFbfQKiXTWlrcn/pEhWEdiQadGCqYufKYgNqqDTFUU9B1/LDNfRguQFke1wDfWE24N9DqnTsxHIMMoxqgRdQEQwMPtlUeEf7EHmHYLv6jpSQYHs7wFbY4IIaKog+ycL8feJcuwDBDcA4Vt00XDZjehyFcE3Tch8V/VFulWJ6Sw7BRr9cdt9kZdZquU7/2xhl4H4Ky9OYMvWL5X8tt5q8Tv20OfkDSyWs/vKJ+GpalsD5UcwXwsP5fhuGo+9lK8KIzJKG65WnrrKdaPw0eaSJpbXYrjc9jeO5vBv3Ne2SbcEaVUJutk75SKRxo05zs0ltZbWDwvMDQna+mFr8ZC9Onbyqd5kC7lK5rH8V/Z0qWtwjDIFnHAs08qb5byhdQg74Fe4cSm3SmxHCEJi5+GM7TSKw7mkZYW7rgD/QP9QUkgUisxLBTwnDky1wjRHTsfBYC2Mc/Sk3II/CUpFmHu0qDjEo2kqbmXmYa4TjN0XqBbK2B0kGJDmq1ef1aT6EXP7Fl2pPDsbbj4EIRYU/pnEQH9w/zF4G2a9AfrsWL/uB46WAIRvXVDNMhSoItVW8zMVPhHBEc8x60ag7QW1stkzLEK07VbzPRfVGKYN6CaE6tDqSM6EyJYSW3loi24nDApAKd1Wt1QCES83kYnlWJctEBFf6neQapC1slrD+shODxY95EzNQcVBZW0oAN5rL2GTBDfv8sdbC5gAWyAf/009ZoAopYV/EuKmNIdwJbEfYOrdNidAF7zlA521wZQ81clhpZLlh4/nVuBqprIzuFhqDVMdSs0l0DN1v9qlWvA5Hc0tJECPiR1atBS32BLvh332XQfUCYUoWsbYUMNbskSI0kTb7dtg6g89laPpBQJUPS5rsZIajvSfvLrIWOYfKPVt6foaZl3Hf3wHez7Zc4aSSQySwfUayUIVtzJ/EF9NzMn6Y6kGelr6SXaZPX6Q0DIWLX6pCYl/torUBtSH/+BmpqYsykS9tkGRLd8uyoPZ3GIrewYB1ZPhGCy+d3qzlQbSaTzhdJMST6IJ4k+bAZhmGz2X/17RIX2ZhxnGHwuMG5zQ7ZdPpKNtYlwdCw2aF3XkLdcJqHAf9EI2fIIf9IOz+dBxoEAh0IVRkadJoAu7zkUjfzDR3yAJxC0v5NJtShU7JQA5RbMCT6FGkv7mS8A/50htrfcH6dnveih0qIqS8ZcRNjaGhLdHE4Gx5FgqpouLKVvp1/HOQ+WpL1e0IM2S7hHRDfc8412liXlSYYiv7T0gPKauhLudC3CEOWdrkJQneLB630AzI2cLmZkV7sBfDEpCkXyxBgeNRQJaOGN/BCt00LLjBnl158HTLNuefxVRjSuDzAi9fhEg0e8Tm8sv/e6HWAJnEgZbmVMiSmQDRihB+BG4DjU4fHxJj+/TworSJX21vGkFAh0TVFdyJc8NCFX1us4YF6JBCp+wbKGDIxdwVvEmtBF5A7b+AUkqiw/uB6H5mahRKGpqC3Aq6mT+gHQA4jnQGs4pcH0DFEYyYhTvkMOSbJJeroY9hHkaEDV9FAPY+R0sLsVgyJaA/bBnqgmPpFhiP4QiPzACyYIfRbrs/ylyHPxzfFsg8nvGJ5SGNa+GysMJlBFh5cAWuKN5fhMZQJT6K1VaRdYNiEY7TmBDR/wBa0Etdi8BiypXg1F3qguCgfnQU431i7hDrYg9YU9oQ5DKUizEhnNYjhCF7QDPtmuI+wLtoZkMPQ8CWsIxc7jEq0v0/5gAUp3igQTIVDjTJlGTIZvepizynMIbJjGX57QBPUnpZgqm2IM+S2SS8wxLQOiS+/3IFU+OlnHOtwD/f8EovY4LknI5UgyGH4R5a+whYs95i2A34kFTslhDOUs+BRhn/04Qi214jOtcPgWm0m5CgO0ePqcs2+0H14adM4SDMuwCK9ANiRX6xjOV6pYEmFQ1BZemmXzuElQ3dlbY/Bv2MiF+igDCXLc0K0r/h5z+YO0hKv9JIKJNVIBSo+0HoayRIr1H0yF7/+YesNWaOLUuMJvu6JROXxYbTqS7L2H601/iyO+UJjDi9lmgr4aF1wnRrl3U5QhsBhBO4HYFbbWRSjidzEIVR647yB65SlZfYpzlAuA4Ke8ju76AZpf2uJGdFDuDmC6ZesU7T6Uu5oeAM9E87+PQdpf0tFr+FArv+wS6y3ITr2UgmQBmyLncp/fmy/l/J2niWAw1en/gQ8oDXCttwNoVjWm22/n9PDNqG46RTAuqZE8aN13rxOr0XAeZbTY767SmNXMev8YoZLjOCyc4Nbg4LW6jMphuhBze8YrzuBZ5AQqbtwNvDXGj7HwrwRQ7S9Bv0c3tYYMeokdZKzgEeS12IdPTMjxxCzSo1PZV5PkG3qQQFxHlzkUiw9RZ1ZpMWmJEN0N+uft4tvkGMb4uGk3zch9zroU4wiam1JyVK4Elb7vgzmBVknSvfH5zvYhUYpogxl9GEdu1Xrs3s9FkpVqG86vWuDeKI6YjmgJywHEuOL5oBPs4Tdg4Be0lUCZ48MJ4NPeeAMJcT4Cr1Va++8IKtK4er4b7QmyK6nM2jMUIYSTZmQRMupLnuOEdQGIg4FDCdFjGljB3w07tdlwm/co3dU+XvsxpeB+OOLCKaIZDOi4kJFNT4Vrvzv4ynuGInkEXt/1Tl+9IIAGhUEJH4qSLSfd4DeUIWCEFlNX/hs7J51s9DtEc+Qii7TufB9C/8IRtffrTlaY8v/r/0Wom0FSSw0iX3kogoewewG7d5HiLNS6EsQwKXIJwidMmr6kgeFjxYsUuUoCeTNhWSEk6B1Ivwq7S+4a+mDtPbmRrefuKDSIPHfZZpzLundlSnlpjRB4s1vdjtfywdmp5j/7uE9Wo+/5tdi8C9wg0CB6/HUUV8UC5SLaTrORjyN+LqDDrm7MGUPoBrIXaOqcJKCRVFcpbUNdx50+9AJAJKt5qYtqwcJkTjHLob6y99lRItpzz5mVX7DtD6SficMfter4w7747YtrSXIqoLr3Pr+pSjwirFFh7dMP8Fslr6/JfOX7gkvm/0yNU3pozYGvYUaLKI58c6+xQaKzNA70M5BmWlZTIui6MjXlGkG8gM94pdSqyPYRD/riXoHyHFHAq0ghI47QbCVHHpBuK/xwLNtbzDL4VHcVHlA7xPEWymEZGQQ5ptNju8CmXugVMDiu/Rg5KAvdCmiKgjdVn3tUDkmSm1axKDHUj15KkIobX6Jgpjb57jEPsdvgbgKepxVfGmrKOrgseJrQcx1/y4XtosggAsBroKub6q9klYOcI8KdRBD/3gCCXOOELujVwksWld84a4CwuXNFirV1k+1QH8QrOQ9BgjE8pOKjTRVBJlqA7NzfnY7kUrO3xVOF0t6iM9ftB89jYaA0FmWd0rgwGSL4VPzO2Ee83ux4qC6tXjS/XcJZ7Ej8vNIWDQdP5kCxDF8m2lyE8nYdLn53/A7oZNsI+FoKLW0dZY/o/7jIsz3M7Nc6hBmUX/ffRIHQhKtYZ6tqWeirT0IMz1tm/SbTy89cThumI/X0cCzTZ3+i7MRQnXT9gbxxz6/ph/7s6BRd4LePDt8+Gk7jrQojqezj8N+3guubqqP4z/HNGtW/zk3PwAAAABJRU5ErkJggg==" class="svg-inject icon-svg icon-svg-md text-green me-5" alt="" />
                        </div>
                        <div>
                            <h4 class="mb-1">Shortener url</h4>
                            <p class="mb-0">Short branded link kamu.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-5">
                        <div>
                            <img src="data:image/png;base64,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" class="svg-inject icon-svg icon-svg-md text-green me-5" alt="" />
                        </div>
                        <div>
                            <h4 class="mb-1">Integrasi Facebook Pixel</h4>
                            <p class="mb-0">Atur Facebook Pixelmu untuk cek Traffic.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row mb-5">
                        <div>
                            <img src="https://cdn.iconscout.com/icon/free/png-256/google-analytics-3628805-3030082.png" class="svg-inject icon-svg icon-svg-md text-green me-5" alt="" />
                        </div>
                        <div>
                            <h4 class="mb-1">Integrasi Google Analytic</h4>
                            <p class="mb-0">Atur Google Analytic untuk cek Traffic.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <img src="https://images.cloudflareapps.com/XxbnWTvHYa__/ic_tag_manager.png?w=256&h=256" class="svg-inject icon-svg icon-svg-md text-red me-5" alt="" />
                        </div>
                        <div>
                            <h4 class="mb-1">Integrasi Google Tag Manager</h4>
                            <p class="mb-0">Atur Google Tag Manager untuk cek Traffic.</p>
                        </div>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary pt-10 pb-12 pt-md-8 pb-md-17">
        <div class="container">
            <h1 class="display-3 text-center">Pricing</h1>
            <div class="row gy-6 align-items-center">
                <div class="col-lg-12 pricing-wrapper">
                    <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
                        <p class="mb-0 pe-3">Bulan</p>
                        <div class="pricing-switchers">
                            <div class="pricing-switcher pricing-switcher-active"></div>
                            <div class="pricing-switcher"></div>
                            <div class="switcher-button bg-primary"></div>
                        </div>
                        <p class="mb-0 ps-3">Tahun <span class="text-red">(Save 50%)</span></p>
                    </div>
                    <?php $result = \Altum\Database\Database::$database->query("SELECT * FROM `packages` WHERE `is_enabled` = 1 ORDER BY `monthly_price` ASC"); ?>
                    <div class="row gy-6 mt-5">
                        <div class="col-md-3">
                            <div class="pricing card shadow-lg">
                                <div class="card-body pt-8">
                                    <div class="prices text-dark">
                                        <div class="price price-show">
                                            <span class="price-currency"></span>
                                            <span class="price-value">14 Hari</span> 
                                        </div>
                                        <div class="price price-hide price-hidden">
                                            <span class="price-currency"></span>
                                            <span class="price-value">14 Hari</span> 
                                        </div>
                                    </div>
                                    <!--/.prices -->
                                    <h4 class="card-title mt-2">Trial</h4>
                                    <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                        <li><i class="uil uil-check"></i><span><strong>20</strong> Projects </span></li>
                                        <li><i class="uil uil-check"></i><span><strong>300K</strong> API Access </span></li>
                                        <li><i class="uil uil-check"></i><span><strong>500MB</strong> Storage </span></li>
                                        <li><i class="uil uil-check"></i><span> Weekly <strong>Reports</strong></span></li>
                                        <li><i class="uil uil-check"></i><span> 7/24 <strong>Support</strong></span></li>
                                    </ul>
                                    <a href="#" class="btn btn-primary rounded">Choose Plan</a>
                                </div>
                                <!--/.card-body -->
                            </div>
                        </div>
                        <!--/.pricing -->
                        <?php while($row = $result->fetch_object()): $settings = json_decode($row->settings);?>
                            <div class="col-md-3">
                                <div class="pricing card shadow-lg">
                                    <div class="card-body pt-8" >
                                        <div class="prices text-dark">
                                            <div class="price price-show">
                                                <span class="price-currency">Rp</span>
                                                <span class="price-value"><?= substr($row->monthly_price, 0, -3); ?>K</span> 
                                                <span class="price-duration">Bulan</span>
                                            </div>
                                            <div class="price price-hide price-hidden">
                                                <span class="price-currency">Rp</span>
                                                <span class="price-value"><?= substr($row->annual_price, 0, -3); ?>K</span> 
                                                <span class="price-duration">Tahun</span>
                                            </div>
                                        </div>
                                        <!--/.prices -->
                                        <h4 class="card-title mt-2"><?= $row->name; ?></h4>
                                        <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                            <?php $result2 = \Altum\Database\Database::$database->query("SELECT * FROM `package_features` ORDER BY `package_features_id` ASC"); ?>
                                            <?php while($row2 = $result2->fetch_object()):
                                            $id = array($row->package_id);
                                            $package_features_id = json_decode($row2->package_id, true);
                                            if (in_array($id[0], $package_features_id)){
                                                echo '<li><i class="uil uil-check"></i><span>'.$row2->name.'</span></li>';
                                            ?>
                                            <?php } ?>
                                            <?php endwhile ?>
                                        </ul>
                                        <a href="#" class="btn btn-primary rounded">Choose Plan</a>
                                    </div>
                                    <!--/.card-body -->
                                </div>
                                <!--/.pricing -->
                            </div>
                        <?php endwhile ?>
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
    </section>
     <!-- /section -->
    <section class="wrapper bg-light pt-10 pt-md-8 pt-md-8 pb-md-17">
        <div class="container">
            <h2 class="fs-15 text-uppercase text-muted text-center mb-8">Trusted by Over 5000 Clients</h2>
            <div class="px-lg-5">
                <div class="row gx-0 gx-md-8 gx-xl-12 gy-8 align-items-center">
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c1.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c2.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c3.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c4.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c5.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                    <div class="col-4 col-md-2">
                        <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img src="./assets/img/brands/c6.png" alt="" /></figure>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /div -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary pt-md-8 pb-md-17">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mx-auto text-center">
                    <h3 class="display-4 mb-10 px-xl-10 px-xxl-15">Feedback Customer</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="grid">
                <div class="row isotope gy-6">
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Cras justo odio dapibus facilisis sociis natoque penatibus.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te1.jpg" srcset="./assets/img/avatars/te1@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Coriss Ambady</h5>
                                            <p class="mb-0">Financial Analyst</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Fusce dapibus, tellus ac cursus tortor mauris condimentum fermentum massa justo sit amet. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te2.jpg" srcset="./assets/img/avatars/te2@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Cory Zamora</h5>
                                            <p class="mb-0">Marketing Specialist</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget porta ac consectetur vestibulum. Donec sed odio dui consectetur adipiscing elit.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te3.jpg" srcset="./assets/img/avatars/te3@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Nikolas Brooten</h5>
                                            <p class="mb-0">Sales Manager</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Etiam adipiscing tincidunt elit convallis felis suscipit ut. Phasellus rhoncus tincidunt auctor. Nullam eu sagittis mauris. Donec non dolor ac elit aliquam tincidunt at at sapien. Aenean tortor libero condimentum ac laoreet vitae.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te4.jpg" srcset="./assets/img/avatars/te4@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Coriss Ambady</h5>
                                            <p class="mb-0">Financial Analyst</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Maecenas sed diam eget risus varius blandit sit amet non magna. Cum sociis natoque penatibus magnis dis montes, nascetur ridiculus mus. Donec sed odio dui. Nulla vitae elit libero a pharetra.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te5.jpg" srcset="./assets/img/avatars/te5@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Jackie Sanders</h5>
                                            <p class="mb-0">Investment Planner</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                    <div class="item col-md-6 col-xl-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <span class="ratings five mb-3"></span>
                                <blockquote class="icon mb-0">
                                    <p>“Donec id elit non mi porta gravida at eget metus. Nulla vitae elit libero, a pharetra augue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.”</p>
                                    <div class="blockquote-details">
                                        <img class="rounded-circle w-12" src="./assets/img/avatars/te6.jpg" srcset="./assets/img/avatars/te6@2x.jpg 2x" alt="" />
                                        <div class="info">
                                            <h5 class="mb-1">Laura Widerski</h5>
                                            <p class="mb-0">Sales Specialist</p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/column -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.grid-view -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light pt-10 pb-12 pt-md-8 pb-md-17">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-xxl-10 mx-auto text-center">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">FAQ</h2>
                    <h3 class="display-4 mb-10 px-lg-12 px-xl-10 px-xxl-15">If you don't see an answer to your question, you can send us an email from our contact form.</h3>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div id="accordion-3" class="accordion-wrapper">
                        <div class="card accordion-item shadow-lg">
                            <div class="card-header" id="accordion-heading-3-1">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-1" aria-expanded="false" aria-controls="accordion-collapse-3-1">How do I get my subscription receipt?</button>
                            </div>
                            <!-- /.card-header -->
                            <div id="accordion-collapse-3-1" class="collapse" aria-labelledby="accordion-heading-3-1" data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.collapse -->
                        </div>
                        <!-- /.card -->
                        <div class="card accordion-item shadow-lg">
                            <div class="card-header" id="accordion-heading-3-2">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-2" aria-expanded="false" aria-controls="accordion-collapse-3-2">Are there any discounts for people in need?</button>
                            </div>
                            <!-- /.card-header -->
                            <div id="accordion-collapse-3-2" class="collapse" aria-labelledby="accordion-heading-3-2" data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.collapse -->
                        </div>
                        <!-- /.card -->
                        <div class="card accordion-item shadow-lg">
                            <div class="card-header" id="accordion-heading-3-3">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-3" aria-expanded="false" aria-controls="accordion-collapse-3-3">Do you offer a free trial edit?</button>
                            </div>
                            <!-- /.card-header -->
                            <div id="accordion-collapse-3-3" class="collapse" aria-labelledby="accordion-heading-3-3" data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.collapse -->
                        </div>
                        <!-- /.card -->
                        <div class="card accordion-item shadow-lg">
                            <div class="card-header" id="accordion-heading-3-4">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-4" aria-expanded="false" aria-controls="accordion-collapse-3-4">How do I reset my Account password?</button>
                            </div>
                            <!-- /.card-header -->
                            <div id="accordion-collapse-3-4" class="collapse" aria-labelledby="accordion-heading-3-4" data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui. Cras justo odio, dapibus ac facilisis.</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.collapse -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.accordion-wrapper -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->



<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/lozad.min.js') ?>"></script>

<script>
    /* Lazy loading */
    const observer = lozad(); observer.observe();
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

