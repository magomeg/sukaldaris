		var $collectionHolder3;


		// setup an "add" link

		var $addTagLink = $('<a href="#" class="add_link">+</a>');

		var $newLinkLi = $('<li></li>').append($addTagLink);



		jQuery(document).ready(function() {

		    // Get the ul that holds the collection of tags

		    $collectionHolder3 = $('ul.tags3');

		    console.log('index');

		    // add a delete link to all of the existing tag form li elements

		    $collectionHolder3.find('li.formrowprod3').each(function() {

		        addTagFormDeleteLink($(this));

		    });



		    // add the "add a tag" anchor and li to the tags ul

		    $collectionHolder3.append($newLinkLi);



		    // count the current form inputs we have (e.g. 2), use that as the new

		    // index when inserting a new item (e.g. 2)

		    $collectionHolder3.data('index', $collectionHolder3.find(':input').length);



		    $addTagLink.on('click', function(e) {

		        // prevent the link from creating a "#" on the URL

		        e.preventDefault();



		        // add a new tag form (see next code block)

		        addTagForm($collectionHolder3, $newLinkLi);

		    });

		});



		function addTagForm($collectionHolder3, $newLinkLi) {

	    // Get the data-prototype explained earlier

		    var prototype = $collectionHolder3.data('prototype');



		    // get the new index

		    var index = $collectionHolder3.data('index');



		    // Replace '__name__' in the prototype's HTML to

		    // instead be a number based on how many items we have

		    var newForm = prototype.replace(/__name__/g, index);



		    // increase the index with one for the next item

		    $collectionHolder3.data('index', index + 1);



		    // Display the form in the page in an li, before the "Add a tag" link li

		    var $newFormLi = $('<li></li>').append(newForm);

		    $newLinkLi.before($newFormLi);



		    // add a delete link to the new form

	    	addTagFormDeleteLink($newFormLi);



		}



		function addTagFormDeleteLink($tagFormLi) {

		    var $removeFormA = $('<a href="#">X</a>');

		    $tagFormLi.append($removeFormA);



		    $removeFormA.on('click', function(e) {

		        // prevent the link from creating a "#" on the URL

		        e.preventDefault();



		        // remove the li for the tag form

		        $tagFormLi.remove();

		    });

		}

