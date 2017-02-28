var offerteInternetWidget = function() {
    
    var model = {
        
        fetchReviews: function ( widget ) {
            var widgetQty = widget.getAttribute( 'data-qty' ),
                query = '?qty=' + widgetQty;
            return get( 'https://www.offerteinternet.net/wp-json/offerte-internet/v1/recensioni' + query ).then( JSON.parse ).catch(function ( error ) {
                throw error;
            });
        }
        
    };
    
    var controller = {
        
        getReviews: function ( widget ) {
            model.fetchReviews( widget ).then( function ( response ) {
                return view.render( response, widget );
            } ). catch( function ( error ) {
                view.renderError();
                console.error( error );
                throw error;
            });
        },
        
        init: function () {
            view.init();
            
            for (var i = 0; i < view.widgetInstances.length; i++) {
                var widget = view.widgetInstances[ i ];
                controller.getReviews( widget );
            }
        }
        
    };
    
    var view = {
        
        init: function () {
            view.widgetInstances = document.querySelectorAll( '.offint-widget' );
            view.offerteWidgetContainer = document.querySelector( '.offint-widget ul ');
            view.spinner = document.querySelector( '.offint-widget .spinner' );
        },
        
        render: function ( reviews, widget ) {
            var thisWidgetUl = widget.querySelector( 'ul' ),
                thisWidgetSpinner = widget.querySelector( '.offint-widget__spinner' ),
                thisWidgetOptin = widget.getAttribute( 'data-optin' );
            
            thisWidgetSpinner.classList.remove( 'is-spinning' );
            
            reviews.forEach(function ( review ) {
                
                var listItem = document.createElement( 'li' ),
                    anchorCompany = document.createElement( 'a' ),
                    spanCompany = document.createElement( 'span' ),
                    imgCompany = document.createElement( 'img' ),
                    anchorReview = document.createElement( 'a' ),
                    spanReview = document.createElement( 'span' ),
                    speedSpan = document.createElement( 'span' ),
                    delPrice = document.createElement( 'del' ),
                    currentPrice = document.createElement( 'span' );
                
                listItem.className = 'offerta';
                
                anchorCompany.className = 'operatore';
                anchorCompany.href = review.compagnia_data.link;
                anchorCompany.title = review.compagnia_data.title;
                
                spanCompany.className = 'operatore';
                
                imgCompany.src = review.compagnia_data.image;
                imgCompany.alt = review.compagnia_data.title;
                
                anchorReview.className = 'offerta__link';
                anchorReview.href = review.permalink;
                anchorReview.title = review.title_attribute;
                anchorReview.textContent = review.r_title;
                
                spanReview.className = 'offerta__link';
                spanReview.textContent = review.r_title;
                
                speedSpan.className = 'speed';
                speedSpan.textContent = review.r_down + ' mega';
                
                delPrice.textContent = review.r_fullprice;
                
                currentPrice.className = 'promo';
                currentPrice.textContent = review.r_price;
                
                if ( thisWidgetOptin === 'on' ) {
                    anchorCompany.appendChild( imgCompany );
                    listItem.appendChild( anchorCompany );
                    listItem.appendChild( anchorReview );
                } else {
                    spanCompany.appendChild( imgCompany );
                    listItem.appendChild( spanCompany );
                    listItem.appendChild( spanReview );
                }
                
                listItem.appendChild( speedSpan );
                listItem.appendChild( delPrice );
                listItem.appendChild( currentPrice );
                
                thisWidgetUl.appendChild( listItem );
                
            });
        },
        
        renderError: function () {
            view.offerteWidgetContainer.textContent = "Qualcosa è andato storto, non abbiamo potuto recuperare le offerte.";
        }
        
    };
    
    function get(url) {
        // Return a new promise.
        return new Promise(function(resolve, reject) {
            // Do the usual XHR stuff
            var req = new XMLHttpRequest();
            req.open('GET', url);
    
            req.onload = function() {
                // This is called even on 404 etc
                // so check the status
                if (req.status == 200) {
                    // Resolve the promise with the response text
                    resolve(req.response);
                } else {
                    // Otherwise reject with the status text
                    // which will hopefully be a meaningful error
                    reject(Error(req.statusText));
                }
            };
    
            // Handle network errors
            req.onerror = function() {
                reject(Error("Network Error"));
            };
    
            // Make the request
            req.send();
        });
    }
    
    controller.init();
    
};

window.addEventListener( 'load', offerteInternetWidget );