function initsearch() {
    var _multiSelect = $('.multiSelect');
    _multiSelect.each(function () {
        let _this = $(this);
        let _selectBtn = _this.find('.selectBtn');
        let _selectContent = _this.find('.selectContent');
        let _optionGroup = _this.find('.optionGroup');
        const speed = 250;

        // 模擬 placeholder 文字
        var placeholder = '<span class="placeholder">' + _selectBtn.attr('data-title') + '</span>';
        if (_selectBtn.text() === "") {
            _selectBtn.prepend(placeholder);
        }

        // 下拉選單顯示／隱藏
        _selectBtn.click(function () {
            if (_optionGroup.is(':visible')) {
                _optionGroup.slideUp(speed);
            } else {
                _optionGroup.slideDown(speed);
                // $(this).parent().siblings().find('.optionGroup').slideUp(speed);
            }
        })
        _selectContent.mouseout(function (e) {
            if (e.relatedTarget.classList.contains('search') || e.relatedTarget.classList.contains('multiSelect')) {
                _optionGroup.slideUp(speed);
            }
        })
        _optionGroup.mouseleave(function () {
            $(this).slideUp(speed);
        })

        // 把選到的項目放到 _selectBtn 中
        _selectBtn.each(function () {
            let _checkOption = $(this).next('.optionGroup').find('input[type="checkbox"]');
            let selected = [];

            _checkOption.click(function () {
                let _optionItem = $(this);
                if (_optionItem.parent().hasClass('checked')) {
                    _optionItem.parent().removeClass('checked');
                    let index = selected.indexOf(_optionItem.parent().text());
                    selected.splice(index, 1);
                    _selectBtn.text(selected.toString());
                    if (selected.toString() === "") {
                        _selectBtn.prepend(placeholder);
                    }
                } else {
                    _optionItem.parent().addClass('checked');
                    selected.push(_optionItem.parent().text());
                    _selectBtn.text(selected.toString());
                }
            })
        })
    })
}

function inputsearch() {
    var searchStyle = document.getElementById('m-search');
    document.getElementById('search-input').addEventListener('input', function () {
        if (!this.value) {
            searchStyle.innerHTML = "";
            return;
        }
        // look ma, no indexOf!
        searchStyle.innerHTML = ".wrap:not([data-index*=\"" + this.value.toLowerCase() + "\"]) { display: none; }";
        // beware of css injections!
    });
}

/*function qinputsearch() {
    var searchStyle = document.getElementById('q-search');
    document.getElementById('qsearch-input').addEventListener('input', function () {
        if (!this.value) {
            searchStyle.innerHTML = "";
            return;
        }
        // look ma, no indexOf!
        searchStyle.innerHTML = ".qwrap:not([data-qindex*=\"" + this.value.toLowerCase() + "\"]) { display: none; }";
        // beware of css injections!
    });
}*/

$(document).ready(function () {
    $('input[name="class[]"]').click(function () {
        var classoption = document.querySelectorAll('input[name="class[]"]');
        var classcheckoption = document.querySelectorAll('input[name="class[]"]:checked');
        let classvalues = [];
        let classcheckvalues = [];
        classoption.forEach((classoption) => {
            classvalues.push(classoption.value);
        });
        classcheckoption.forEach((classcheckoption) => {
            classcheckvalues.push(classcheckoption.value);
        });
        if (classcheckvalues.length != 0) {
            for (var i = 0; i < classvalues.length; i++) {
                if (classcheckvalues.includes(classvalues[i])) { //顯示
                    showid = "search-" + classvalues[i];
                    document.getElementById(showid).style.display = "block";
                } else { //不顯示
                    showid = "search-" + classvalues[i];
                    document.getElementById(showid).style.display = "none";
                }
            }
        } else {
            for (var i = 0; i < classvalues.length; i++) {
                showid = "search-" + classvalues[i];
                document.getElementById(showid).style.display = "block";
            }
        }
    })

    $('input[name="year[]"]').click(function () {
        var yearoption = document.querySelectorAll('input[name="year[]"]');
        var yearcheckoption = document.querySelectorAll('input[name="year[]"]:checked');
        let yearvalues = [];
        let yearcheckvalues = [];
        yearoption.forEach((yearoption) => {
            yearvalues.push(yearoption.value);
        });
        yearcheckoption.forEach((yearcheckoption) => {
            yearcheckvalues.push(yearcheckoption.value);
        });
        if (yearcheckvalues.length != 0) {
            for (var i = 0; i < yearvalues.length; i++) {
                if (yearcheckvalues.includes(yearvalues[i])) { //顯示
                    showid = "search-" + yearvalues[i];
                    document.getElementById(showid).style.display = "block";
                } else { //不顯示
                    showid = "search-" + yearvalues[i];
                    document.getElementById(showid).style.display = "none";
                }
            }
        } else {
            for (var i = 0; i < yearvalues.length; i++) {
                showid = "search-" + yearvalues[i];
                document.getElementById(showid).style.display = "block";
            }
        }
    })

    /*$('input[name="qclass[]"]').click(function () {
        var qclassoption = document.querySelectorAll('input[name="qclass[]"]');
        var qclasscheckoption = document.querySelectorAll('input[name="qclass[]"]:checked');
        let qclassvalues = [];
        let qclasscheckvalues = [];
        qclassoption.forEach((qclassoption) => {
            qclassvalues.push(qclassoption.value);
        });
        qclasscheckoption.forEach((qclasscheckoption) => {
            qclasscheckvalues.push(qclasscheckoption.value);
        });
        console.log(qclassvalues);
        if (qclasscheckvalues.length != 0) {
            for (var i = 0; i < qclassvalues.length; i++) {
                if (qclasscheckvalues.includes(qclassvalues[i])) { //顯示
                    showid = "qsearch-" + qclassvalues[i];
                    for(var j = 0 ; j< document.getElementsByName(showid).length ; j++){
                        document.getElementsByName(showid)[j].style.display = "block";
                    }
                } else { //不顯示
                    showid = "qsearch-" + qclassvalues[i];
                    for(var j = 0 ; j< document.getElementsByName(showid).length ; j++){
                        document.getElementsByName(showid)[j].style.display = "none";
                    }
                }
            }
        } else {
            for (var i = 0; i < qclassvalues.length; i++) {
                showid = "qsearch-" + qclassvalues[i];
                for(var j = 0 ; j< document.getElementsByName(showid).length ; j++){
                    document.getElementsByName(showid)[j].style.display = "block";
                }
            }
        }
    })

    $('input[name="qyear[]"]').click(function () {
        var yearoption = document.querySelectorAll('input[name="qyear[]"]');
        var yearcheckoption = document.querySelectorAll('input[name="qyear[]"]:checked');
        let yearvalues = [];
        let yearcheckvalues = [];
        yearoption.forEach((yearoption) => {
            yearvalues.push(yearoption.value);
        });
        yearcheckoption.forEach((yearcheckoption) => {
            yearcheckvalues.push(yearcheckoption.value);
        });
        if (yearcheckvalues.length != 0) {
            for (var i = 0; i < yearvalues.length; i++) {
                if (yearcheckvalues.includes(yearvalues[i])) { //顯示
                    showid = "qsearch-" + yearvalues[i];
                    document.getElementById(showid).style.display = "block";
                } else { //不顯示
                    showid = "qsearch-" + yearvalues[i];
                    document.getElementById(showid).style.display = "none";
                }
            }
        } else {
            for (var i = 0; i < yearvalues.length; i++) {
                showid = "qsearch-" + yearvalues[i];
                document.getElementById(showid).style.display = "block";
            }
        }
    })*/
})



