const Block = (() => {

    function createRequest(name, data = {})
    {
        let uri = Config.get('block.uris.create');
        uri = Helpers.replaceUriSlugs(uri, name);
        return Helpers.get(uri, data);
    }

    function storeRequest(name, data = {})
    {
        let uri = Config.get('block.uris.store');
        uri = Helpers.replaceUriSlugs(uri, name);
        return Helpers.post(uri, data);
    }

    function deleteRequest(blockId, data = {})
    {
        let uri = Config.get('block.uris.delete');
        uri = Helpers.replaceUriSlugs(uri, blockId);
        return Helpers._delete(uri, data);
    }

    function editRequest(blockId, data = {})
    {
        let uri = Config.get('block.uris.edit');
        uri = Helpers.replaceUriSlugs(uri, blockId);
        return Helpers.get(uri, data);
    }

    function updateRequest(blockId, data = {})
    {
        let uri = Config.get('block.uris.edit');
        uri = Helpers.replaceUriSlugs(uri, blockId);
        return Helpers.get(uri, data);
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