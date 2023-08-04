jQuery(document).ready(function($) {
    function updateFavoriteStar(candidateId, favorited) {
        if (favorited) {
            $('.favorite-star[data-candidate-id="' + candidateId + '"]').text('★'); // заповнена зірка
            $('.favorite-star').addClass('favorited'); // заповнена зірка
        } else {
            $('.favorite-star[data-candidate-id="' + candidateId + '"]').text('☆'); // порожня зірка
            $('.favorite-star').removeClass('favorited'); // заповнена зірка

        }
    }
    $('.favorite-star').each(function() {
        var candidateId = $(this).data('candidate-id');

        $.ajax({
            url: my_theme_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'check_favorite_candidate',
                user_id: currentUserId,
                candidate_id: candidateId,
            },
            success: function(response) {
                if (response.success) {
                    updateFavoriteStar(candidateId, response.data.is_favorited);
                }
            },
        });
    });
    var ajaxInProgress = false;
    $('body').on('click', '.favorite-star', function () {
        if (ajaxInProgress) return;
        var candidateId = $(this).data('candidate-id');
        var isFavorited = $(this).hasClass('favorited');
        ajaxInProgress = true;
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'toggle_favorite_candidate',
                candidate_id: candidateId,
                favorited: isFavorited,
            },
            success: function(response) {
                if (response.success) {
                    if (isFavorited) {
                        $('.favorite-star[data-candidate-id="' + candidateId + '"]').removeClass('favorited').text('☆');
                    } else {
                        $('.favorite-star[data-candidate-id="' + candidateId + '"]').addClass('favorited').text('★');
                    }
                    $('.candidate-container[data-candidate-id="' + candidateId + '"]').css('display', 'none');
                    let candToHide = $('.pipe1 .myCandW').find('.favorite-star[data-candidate-id="' + candidateId + '"]');
                    if(!$(candToHide).hasClass('favorited')) {
                        $('.pipe1 .favorite-star[data-candidate-id="' + candidateId + '"]').parent().parent().css('display', 'none');
                    }
                } else {
                    alert('Щось пішло не так, спробуйте ще раз.');
                }
            },
            error: function() {
                alert('Помилка AJAX, спробуйте ще раз.');
            },
            complete: function() {
                // независимо от того, удался AJAX-запрос или нет, устанавливаем состояние обратно в false, поскольку AJAX-запрос закончился
                ajaxInProgress = false;
            },
        });
    });
});
