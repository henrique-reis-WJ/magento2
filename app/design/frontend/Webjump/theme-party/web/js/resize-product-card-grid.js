require(["jquery"], function ($) {
    $(document).ready(function () {
        resizeGrid();

        function resizeGrid() {
            var cont = 0;
            var nSize = 0;
            var pSize = 0;
            var linecont = 0;

            $(".product-items").each(function () {
                var linebreak = 4;

                if ($(window).width() <= 770) {
                    var linebreak = 2;
                }

                $(this)
                    .find(".product-item")
                    .each(function () {
                        nameSize = $(this).find(".product-item-name").height();
                        priceSize = $(this).find(".price-box").height();

                        if (cont != 0 && cont % linebreak == 0) {
                            if (nSize > 0) {
                                $(
                                    ".product-item-name.websizename-" + linecont
                                ).each(function () {
                                    $(this).height(nSize);
                                });
                            }

                            if (pSize > 0) {
                                $(".price-box.websizename-" + linecont).each(
                                    function () {
                                        $(this).height(pSize);
                                    }
                                );
                            }

                            linecont++;
                            nSize = pSize = 0;
                        }

                        nameSize = parseInt(nameSize);
                        if (nameSize > nSize) {
                            nSize = nameSize;
                        }
                        $(this)
                            .find(".product-item-name")
                            .addClass("websizename-" + linecont);

                        priceSize = parseInt(priceSize);
                        if (priceSize > pSize) {
                            pSize = priceSize;
                        }
                        $(this)
                            .find(".price-box")
                            .addClass("websizename-" + linecont);

                        cont++;
                    });
            });

            if (nSize > 0) {
                $(".product-item-name.websizename-" + linecont).each(
                    function () {
                        $(this).height(nSize);
                    }
                );
            }

            if (pSize > 0) {
                $(".price-box.websizename-" + linecont).each(function () {
                    $(this).height(pSize);
                });
            }
        }
    });
});
