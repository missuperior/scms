    // add elemnent
    // dom
    // addElement('clonedInput2', 'div', 'file-'+fileId, html);
    function addElement(parentId, elementTag, elementId, html) {
        // Adds an element to the document
        var p = document.getElementById(parentId);
        var newElement = document.createElement(elementTag);
        newElement.setAttribute('id', elementId);
        newElement.innerHTML = html;
        p.appendChild(newElement);
    }

    // Remove element dom
    function removeElement(elementId) {
        // Removes an element from the document
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
    }