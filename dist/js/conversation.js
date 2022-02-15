/*Copyright Covenant T. Elijah*/
$(document).ready(function() {
    var off = "<svg viewBox='0 0 24 24' fill='#bdbac2' id='dark' style='-webkit-user-select: none;margin: 5% 20%;cursor: pointer; text-align: center; height: 50px; width: 60%!important;'><g><path d='M1.626 17.87c.125 0 .253-.03.37-.098.36-.205.485-.663.28-1.023-.355-.627-.544-1.343-.544-2.07 0-2.218 1.732-4.02 3.913-4.172.018.282.046.564.096.84.067.36.383.614.738.614.045 0 .09-.004.136-.012.407-.074.678-.465.604-.873-.062-.34-.094-.69-.094-1.04 0-3.204 2.606-5.81 5.81-5.81.58 0 1.15.085 1.702.253.394.123.814-.103.937-.498.12-.396-.103-.815-.5-.937-.69-.21-1.41-.318-2.14-.318-3.673 0-6.714 2.727-7.225 6.262-3.04.118-5.475 2.62-5.475 5.69 0 .986.256 1.958.74 2.81.138.243.39.38.653.38zm18.554-6.802c.03-.312.063-.78.063-1.032 0-.59-.07-1.177-.21-1.745-.1-.4-.503-.645-.907-.55-.402.1-.648.506-.55.908.11.45.167.92.167 1.388 0 .203-.03.615-.055.888-2.067.132-3.816 1.567-4.306 3.603-.097.402.15.808.555.904.397.094.808-.15.904-.554.352-1.46 1.647-2.48 3.15-2.48 1.788 0 3.242 1.455 3.242 3.242s-1.454 3.24-3.24 3.24H8.454c-.414 0-.75.336-.75.75s.336.75.75.75H18.99c2.615 0 4.742-2.126 4.742-4.74 0-2.2-1.514-4.038-3.55-4.57zm.878-8.848c-.293-.293-.768-.293-1.06 0l-19 19c-.294.293-.294.768 0 1.06.145.147.337.22.53.22s.383-.072.53-.22l19-19c.293-.293.293-.767 0-1.06z'></path></g></svg>";
    function retry(recipient, sender, message) {
        typed();
        $.ajax({
            url: 'message-log',
            type: 'POST',
            data: {
                'message': message,
                'fetch': true,
                'sender': sender,
                'recipient': recipient
            },
            success: function(data) {
                if (data == off) {
                    retry(recipient, sender, message);
                } else {
                    typed();
                    chats();
                    $("#content").animate({
                        scrollTop: 10000
                    }, 2000);
                    uns__JKlnU__hjh(message, data);
                    setTimeout(function() {
                        var audio = document.getElementById('audio1');
                        audio.play();
                        $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
                            'fetch': true
                        })
                    }, 1000);
                    U__wjbb_WoXomqg0gWenL0tC6_flf();
                }
            },
            error: function(data) {
                retry(recipient, sender, message);
            }
        });
    }
    $('button#active-send').hide();
    function uns__JKlnU__hjh(message, data) {
        $('#active-unsent').children('.message:first-of-type').remove();
        $('#active-message-box').append("<div class='message me'><div class='text-main'> <div class='text-group me'> <div class='text me'><p id='exec'>" + message + "</div></div><span><i class='material-icons'>check</i>" + data + "</span></div></div>");
    }
    function delete_notif() {
        var sender = $('#active-name').html();
        $.ajax({
            url: 'notification',
            type: 'POST',
            data: {
                'delete': true,
                'sender': sender
            },
            success: function(data) {}
        })
    }
    setTimeout(function discussions() {
        var load = $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
        if (load) {} else {
            discussions()
        }
    }, 2000);
    setTimeout(function friends() {
        var load = $('.all-friends').load('users-list?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
        if (load) {} else {
            friends();
        }
    }, 2000);
    function chats() {
        $('#chat').load('chats?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    }
    setTimeout(chats, 10000);
    setTimeout(function fellas() {
        $('#fellas').load('fellas?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    }, 10000);
    function fellas() {
        $('#fellas').load('fellas?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    }
    function offline() {
        $.ajax({
            url: 'logout.php',
            type: 'GET',
            data: {
                'inactivity': true
            },
            success: function(data) {},
            error: function(data) {}
        })
    }
    setTimeout(function() {
        $.ajax({
            url: 'set-active?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim',
            type: 'POST',
            data: {
                'set-active': true
            },
            success: function(data) {},
            error: function(data) {
                offline();
            }
        });
        $.ajax({
            url: 'log?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim',
            type: 'POST',
            data: {
                'log': true
            },
            success: function(data) {},
            error: function(data) {
                offline();
            }
        });
    }, 2000);
    $('textarea.text').on('click', function() {
        var recipient = $('#active-friend-status').attr('recipient');
        var sender = $('#active-friend-status').attr('sender');
        var bond = [];
        bond = [recipient, sender];
        bond.sort();
        bond = bond.join('|');
        $.ajax({
            url: 'typing?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim',
            type: 'POST',
            data: {
                'typing': true,
                'bond': bond
            },
            success: function(data) {
                setTimeout(typed, 40000);
            },
            error: function(data) {}
        });
    });
    $('textarea.text').on('keydown', function() {
        setTimeout(function() {
            var message = $('textarea.text').val();
            if (message == '') {
                $('button#active-send').hide();
                $('label#active-attach1').show();
                $('label#active-attach2').show();
                $('label#active-mic').show();
            } else {
                $('button#active-send').show();
                $('label#active-attach1').hide();
                $('label#active-attach2').hide();
                $('label#active-mic').hide();
            }
        }, 200);
    });
    $('textarea.inactive-text').on('keydown', function() {
        setTimeout(function() {
            var message = $('textarea.inactive-text').val();
            if (message == '') {
                $('button#inactive-send').hide();
                $('label#inactive-attach').show();
                $('label#inactive-mic').show();
            } else {
                $('button#inactive-send').show();
                $('label#inactive-attach').hide();
                $('label#inactive-mic').hide();
            }
        }, 200);
    });
    function typed() {
        var user = $('title').html();
        var recipient = $('.connect').attr('recipient');
        var sender = $('.connect').attr('sender');
        var bond = [];
        bond = [recipient, sender];
        bond.sort();
        bond = bond.join('|');
        $.ajax({
            url: 'typing',
            type: 'POST',
            data: {
                'typed': true,
                'user': user,
                'bond': bond
            },
            cache: false,
            success: function(data) {
                $('#typing').html('');
                $("#content").animate({
                    scrollTop: 10000
                }, 100);
            },
            error: function(data) {}
        });
    }
    $('#create-chat1').on('click', function() {
        var reciever = $('.reciever1').val();
        reciever = reciever.split(' ');
        var fname = reciever[0];
        var lname = reciever[1];
        var message = $('#message1').val();
        if ((reciever == '') && (message == '') && (fname == '') && (lname == '')) {
            sweetAlert("Oops...", "Please fill in valid data. ", "error");
        } else {
            $.ajax({
                url: 'create-chat',
                type: 'POST',
                data: {
                    'create-chat': true,
                    'recipient': reciever,
                    'message': message,
                    'fname': fname,
                    'lname': lname
                },
                success: function(data) {
                    if (data == off) {
                        sweetAlert("Oops...", "Connection Error ", "error");
                    } else {
                        $('.id010').html("<h6 style='color: #fa4545'>" + data + "</h6>");
                        document.getElementById('id010').style.display = 'block';
                        $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
                            'fetch': true
                        })
                    }
                },
                error: function(data) {}
            })
        }
    });
    $('#create-chat2').on('click', function() {
        var name = $('#name').val();
        var recipient = $('#recipient').val();
        var reciever = $('.reciever2').val();
        var message = $('#message2').val();
        if ((reciever == '') && (message == '')) {
            sweetAlert("Oops...", "Please fill in valid data. ", "error");
        } else {
            $.ajax({
                url: 'create-chat',
                type: 'POST',
                data: {
                    'create-new-chat': true,
                    'recipient': recipient,
                    'email': reciever,
                    'message': message
                },
                success: function(data) {
                    if (data == off) {
                        sweetAlert("Oops...", "Connection Error ", "error");
                    } else {
                        fellas();
                        swal(data + " ");
                        $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
                            'fetch': true
                        })
                    }
                },
                error: function(data) {}
            })
        }
    });
    $('button#active-send').on('click', function() {
        typed();
        $('#emojikb-maindiv').addClass('emojikb-hidden');
        $('button#active-send').hide();
        $('label#active-attach1').show();
        $('label#active-attach2').show();
        $('label#active-mic').show();
        var recipient = $('#active-friend-status').attr('recipient');
        var sender = $('#active-friend-status').attr('sender');
        var message = $('textarea.text').val();
        if ((message != '') && (recipient != '') && (sender != '')) {
            $('textarea.text').val('');
            $('#active-unsent').append("<div class='message me zoomInRight'><div class='text-main'> <div class='text-group me'> <div class='text me'> <p id='exec'>" + message + "</p> </div></div><span><i class=\"material-icons\">cloud</i></span> </div> </div>");
            $("#content").animate({
                scrollTop: 10000
            }, 2000);
            $.ajax({
                url: 'message-log',
                type: 'POST',
                data: {
                    'message': message,
                    'fetch': true,
                    'sender': sender,
                    'recipient': recipient
                },
                success: function(data) {
                    if (data == off) {
                        sweetAlert("Oops...", "Connection Error ", "error");
                        retry(recipient, sender, message);
                    } else {
                        typed();
                        chats();
                        $("#content").animate({
                            scrollTop: 10000
                        }, 2000);
                        uns__JKlnU__hjh(message, data);
                        setTimeout(function() {
                            var audio = document.getElementById('audio1');
                            audio.play();
                            $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
                                'fetch': true
                            })
                        }, 1000);
                        U__wjbb_WoXomqg0gWenL0tC6_flf();
                    }
                },
                error: function(data) {
                    sweetAlert("Oops...", "Connection Error ", "error");
                    retry(recipient, sender, message);
                }
            });
        }
    });
    $('#like').on('click', function() {
        $.ajax({
            url: 'message-log',
            type: 'POST',
            data: {
                'like': 'like',
                'fetch': true
            },
            success: function(data) {
                var newHeight = $("body,html").height();
                if (newHeight > oldHeight) {
                    $("body,html").animate({
                        scrollTop: newHeight
                    }, 1500);
                }
                setTimeout(function() {
                    var audio = document.getElementById('audio1');
                    audio.play();
                }, 1000);
            },
            error: function(data) {}
        });
    });
    $('.all-friends').load('users-list?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim');
    $('#all').on('click', function() {
        $('.online-friends').hide();
        $('.offline-friends').hide();
        $('.all-friends').show();
        $('.all-friends').load('users-list?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim');
    });
    $('#online').on('click', function() {
        $('.all-friends').hide();
        $('.offline-friends').hide();
        $('.online-friends').show();
        $('.online-friends').load('online-friends?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim');
    });
    $('#offline').on('click', function() {
        $('.all-friends').hide();
        $('.online-friends').hide();
        $('.offline-friends').show();
        $('.offline-friends').load('offline-friends?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim');
    });
    $('#all-discussions').on('click', function() {
        $('.read').hide();
        $('.unread').hide();
        $('.all-discussions').show();
        $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    });
    $('#read').on('click', function() {
        $('.all-discussions').hide();
        $('.unread').hide();
        $('.read').show();
        $('.read').load('read?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    });
    $('#unread').on('click', function() {
        $('.all-discussions').hide();
        $('.read').hide();
        $('.unread').show();
        $('.unread').load('unread?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
            'fetch': true
        });
    });
    $("#backtobottom").on('dblclick', function() {
        $('#sidebar').addClass('mini');
        $('#nav-tabContent').removeClass('mini');
        $("#content").animate({
            scrollTop: 10000
        }, 600);
        $("#active-content").animate({
            scrollTop: 10000
        }, 600);
        $("body,html").animate({
            scrollTop: $(document).height()
        }, 600);
        $("#backtobottom").removeClass("visible");
    });
    $(window).scroll(function() {
        if ($(window).scrollTop() < $(window).height() - 50) {
            jQuery("#backtobottom").addClass("visible");
        } else {
            jQuery("#backtobottom").removeClass("visible");
        }
    });
    $("#content").scroll(function() {
        if ($("#content").scrollTop() < $("#content").height()) {
            jQuery("#backtobottom").addClass("visible");
        } else {
            jQuery("#backtobottom").removeClass("visible");
        }
    });
    $("#active-content").scroll(function() {
        if ($("#active-content").scrollTop() < $("#active-content").height()) {
            jQuery("#backtobottom").addClass("visible");
        } else {
            jQuery("#backtobottom").removeClass("visible");
        }
    });
    $('#same-address').on('click', function() {
        $('#same-address').toggleClass('clear');
    });
    $('#clear-history').on('click', function() {
        if ($('#same-address').hasClass('clear')) {
            $.ajax({
                url: 'clear-chat',
                type: 'POST',
                data: {
                    'clear-chat': true
                },
                success: function(data) {
                    $('#same-address').removeClass('clear');
                    $('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {
                        'fetch': true
                    })
                },
                error: function() {}
            })
        }
    });
    $('#active-clear').on('click', function() {
        var contact = $('#active-friend-status').attr('recipient');
        var bond = $('#active-friend-status').attr('bond');
        $.ajax({
            url: 'clear-history',
            type: 'POST',
            data: {
                'clear': true,
                'bond': bond,
                'contact': contact
            },
            success: function(data) {},
            error: function() {}
        })
    });
    $('#active-block').on('click', function() {
        if ($('#active-block').html() == '<i class="material-icons">block</i>Block Contact') {
            var contact = $('#active-friend-status').attr('recipient');
            $.ajax({
                url: 'block-contact',
                type: 'POST',
                data: {
                    'block': true,
                    'contact': contact
                },
                success: function(data) {
                    $('#active-block').html('<i class="material-icons">block</i>Unblock Contact');
                },
                error: function() {}
            })
        } else {
            var contact = $('#active-friend-status').attr('recipient');
            $.ajax({
                url: 'block-contact',
                type: 'POST',
                data: {
                    'unblock': true,
                    'contact': contact
                },
                success: function(data) {
                    $('#active-block').html('<i class="material-icons">block</i>Block Contact');
                },
                error: function() {}
            })
        }
    });
    $('#inactive-block').on('click', function() {
        if ($('#inactive-block').html() == '<i class="material-icons">block</i>Block Contact') {
            var contact = $('#inactive-friend-status').attr('recipient');
            $.ajax({
                url: 'block-contact',
                type: 'POST',
                data: {
                    'block': true,
                    'contact': contact
                },
                success: function(data) {
                    $('#inactive-block').html('<i class="material-icons">block</i>Unblock Contact');
                },
                error: function() {}
            })
        } else {
            var contact = $('#inactive-friend-status').attr('recipient');
            $.ajax({
                url: 'block-contact',
                type: 'POST',
                data: {
                    'unblock': true,
                    'contact': contact
                },
                success: function(data) {
                    $('#inactive-block').html('<i class="material-icons">block</i>Block Contact');
                },
                error: function() {}
            })
        }
    });
    $('#active-delete').on('click', function() {
        var bond = $('#active-friend-status').attr('bond');
        var recipient = $('#active-friend-status').attr('recipient');
        $.ajax({
            url: 'delete-contact',
            type: 'POST',
            data: {
                'delete': true,
                'bond': bond,
                'recipient': recipient
            },
            success: function(data) {
                $('#active-friend-status').attr('recipient', '');
                $('#active-friend-status').attr('sender', '');
                $('#active-friend-status').attr('bond', '');
                $('#active-friend-name').html("Deleted");
            },
            error: function() {}
        })
    });
    $('#inactive-delete').on('click', function() {
        var bond = $('#inactive-friend-status').attr('bond');
        var recipient = $('#inactive-friend-status').attr('recipient');
        $.ajax({
            url: 'delete-contact',
            type: 'POST',
            data: {
                'delete': true,
                'bond': bond,
                'recipient': recipient
            },
            success: function(data) {
                $('#inactive-friend-status').attr('recipient', '');
                $('#inactive-friend-status').attr('sender', '');
                $('#inactive-friend-status').attr('bond', '');
                $('#inactive-friend-name').html("Deleted");
            },
            error: function() {}
        })
    });
    $('#quit').on('click', function() {
        window.location = 'sign-in';
    });
    $('.quit').on('click', function() {
        window.location = 'sign-in';
    });
    $('#delete-account').on('click', function() {
        var audio = document.getElementById('audio2');
        audio.play();
        swal({
            title: "Are you sure you want to delete your Account with GistApp?",
            text: "All data will be lost. ",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: !1
        });
    });
    $('.confirm').on('touchend click', function() {
        if (($('.confirm').hasClass('later')) && ($('.confirm').html() == 'Delete')) {}
    });
    $('#update').on('click', function() {
        var fname = $('#firstName').val();
        var lname = $('#lastName').val();
        var phone = $('#phoneNo').val();
        var about = $('#about').val();
        if ((fname != '') && (lname != '') && (phone != '') && (about != '')) {
            $.ajax({
                url: 'update-profile',
                type: 'POST',
                data: {
                    'update': true,
                    'fname': fname,
                    'lname': lname,
                    'phone': phone,
                    'about': about
                },
                success: function(data) {
                    console.log(data);
                    swal("Updated ", "Updating taking effect ", "success");
                    $('#collapseOne').hide();
                },
                error: function(data) {
                    sweetAlert("Oops...", "Error updating your Profile. Seems you are offline. ", "error");
                }
            })
        }
    });
    $.ajax({
        url: 'avatar',
        type: 'POST',
        data: {
            'fetch': true
        },
        success: function(data) {
            $('.avatar-xl').attr('src', data);
        }
    });
    $("#content").on('scroll', function() {
        if ($("#content").scrollTop() == 0) {
            var bond = $('#active-friend-status').attr('bond');
            $.ajax({
                url: 'message',
                type: 'POST',
                data: {
                    'offset': true,
                    'bond': bond
                },
                success: function(data) {
                    if (data == off) {
                        sweetAlert("Oops...", "Can't fetch previous messages!\r\n\r\nConnection Error ", "error");
                    } else {
                        $("#active-message-box").prepend(data);
                    }
                },
                error: function(data) {
                    sweetAlert("Oops...", "Can't fetch previous messages!\r\n\r\nConnection Error ", "error");
                }
            })
        }
    });
    setInterval(function() {
        $.ajax({
            url: 'log?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim',
            type: 'POST',
            data: {
                'log': true
            },
            success: function(data) {},
            error: function(data) {
                offline();
            }
        });
    }, 60000*5);
});
