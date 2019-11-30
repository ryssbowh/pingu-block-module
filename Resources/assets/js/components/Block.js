import * as h from 'PinguHelpers';

const Block = (() => {

    function createRequest(name, data = {})
    {
        let uri = h.config('block.uris.create');
        uri = h.replaceUriSlugs(uri, name);
        return h.get(uri, data);
    }

    function storeRequest(name, data = {})
    {
        let uri = h.config('block.uris.store');
        uri = h.replaceUriSlugs(uri, name);
        return h.post(uri, data);
    }

    function deleteRequest(blockId, data = {})
    {
        let uri = h.config('block.uris.delete');
        uri = h.replaceUriSlugs(uri, blockId);
        return h._delete(uri, data);
    }

    function editRequest(blockId, data = {})
    {
        let uri = h.config('block.uris.edit');
        uri = h.replaceUriSlugs(uri, blockId);
        return h.get(uri, data);
    }

    function updateRequest(blockId, data = {})
    {
        let uri = h.config('block.uris.edit');
        uri = h.replaceUriSlugs(uri, blockId);
        return h.get(uri, data);
    }

    return {
        createRequest: createRequest,
        storeRequest: storeRequest,
        deleteRequest: deleteRequest,
        editRequest: editRequest,
        updateRequest: updateRequest,
    };

})();

export default Block;