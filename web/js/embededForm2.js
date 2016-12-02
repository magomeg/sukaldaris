		var $collectionHolder1;



		// setup an "add" link

		var $addTagLink1 = $('<a href="#" class="add_link">+</a>');

		var $newLinkLi1 = $('<li></li>').append($addTagLink1);



		jQuery(document).ready(function() {

		   



		    // Get the ul that holds the collection of tags

		    $collectionHolder1 = $('ul.tags1');



		    // add a delete link to all of the existing tag form li elements

		    $collectionHolder1.find('li.formrowprod1').each(function() {

		        addTagFormDeleteLink($(this));

		    });



		    // add the "add a tag" anchor and li to the tags ul

		    $collectionHolder1.append($newLinkLi1);



		    // count the current form inputs we have (e.g. 2), use that as the new

		    // index1 when inserting a new item (e.g. 2)

		    $collectionHolder1.data('index1', $collectionHolder1.find(':input').length);



		    $addTagLink1.on('click', function(e) {

		        // prevent the link from creating a "#" on the URL

		        e.preventDefault();



		        // add a new tag form (see next code block)

		        addTagForm($collectionHolder1, $newLinkLi1);

		    });

		});



		function addTagForm($collectionHolder1, $newLinkLi1) {

	    // Get the data-prototype1 explained earlier

		    var prototype1 = $collectionHolder1.data('prototype1');

		    console.log(prototype1);

		    // get the new index1

		    var index1 = $collectionHolder1.data('index1');

		    console.log(index1);

		    // Replace '__name__' in the prototype1's HTML to

		    // instead be a number based on how many items we have

		    var newForm1 = prototype1.replace(/__name__/g, index1);



		    // increase the index1 with one for the next item

		    $collectionHolder1.data('index1', index1 + 1);



		    // Display the form in the page in an li, before the "Add a tag" link li

		    var $newForm1Li = $('<li></li>').append(newForm1);

		    $newLinkLi1.before($newForm1Li);



		    // add a delete link to the new form

	    	addTagFormDeleteLink($newForm1Li);



		}



		function addTagFormDeleteLink($tagFormLi1) {

		    var $removeFormA1 = $('<a href="#">X</a>');

		    $tagFormLi1.append($removeFormA1);



		    $removeFormA1.on('click', function(e) {

		        // prevent the link from creating a "#" on the URL

		        e.preventDefault();



		        // remove the li for the tag form

		        $tagFormLi1.remove();

		    });

		}

