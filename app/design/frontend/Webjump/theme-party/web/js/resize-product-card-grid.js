require(["jquery"], function ($) {
    $(document).ready(function () {
        resizeGrid();

        function resizeGrid() {
            var cont = 0;
            var sSize = 0;
            var nSize = 0;
            var pSize = 0;
            var aSize = 0;
            var linecont = 0;

            $(".product-items").each(function () {
                var linebreak = 4;

                if ($(window).width() <= 770) {
                    var linebreak = 2;
                }

                $(this)
                    .find(".product-item")
                    .each(function () {
                        stockSize = $(this).find(".stock").height();
                        nameSize = $(this).find(".product-item-name").height();
                        priceSize = $(this).find(".price-box").height();
                        attributeSize = $(this)
                            .find(".productAttributes")
                            .height();

                        if (cont != 0 && cont % linebreak == 0) {
                            if (sSize > 0) {
                                $(".stock.websizename-" + linecont).each(
                                    function () {
                                        $(this).height(sSize);
                                    }
                                );
                            }

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

                            if (aSize > 0) {
                                $(
                                    ".productAttributes.websizename-" + linecont
                                ).each(function () {
                                    $(this).height(aSize);
                                });
                            }

                            linecont++;
                            sSize = nSize = pSize = aSize = 0;
                        }

                        stockSize = parseInt(stockSize);
                        if (stockSize > sSize) {
                            sSize = stockSize;
                        }
                        $(this)
                            .find(".stock")
                            .addClass("websizename-" + linecont);

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

                        attributeSize = parseInt(attributeSize);
                        if (attributeSize > aSize) {
                            aSize = attributeSize;
                        }
                        $(this)
                            .find(".productAttributes")
                            .addClass("websizename-" + linecont);

                        cont++;
                    });
            });

            if (sSize > 0) {
                $(".stock.websizename-" + linecont).each(function () {
                    $(this).height(sSize);
                });
            }

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

            if (aSize > 0) {
                $(".productAttributes.websizename-" + linecont).each(
                    function () {
                        $(this).height(aSize);
                    }
                );
            }
        }
    });
});
