<?php
/**
 * @FileName    :   BaseModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 16:35:02
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

abstract class BaseModel
{
    abstract protected function _getOrmName();
    abstract protected function _filter($sql, $params);

	public function getCount($params = array())
    {
        $orm = $this->_getOrmName();
        $sql = new $orm;
        $sql = $this->_filter($sql, $params);
        return $sql->count();
    }

    public function getRow($id)
    {
        $orm = $this->_getOrmName();
        $row = $orm::where('id', '=', intval($id))->first();
        return $row;
    }

    public function findByIds($ids)
    {
        $retval = array();
        if (empty($ids))
            return $retval;

        $orm = $this->_getOrmName();
        $rows = $orm::whereIn('id', $ids)->get();
        foreach ($rows as &$r) {
            $retval[$r->id] = $r;
        }
        return $retval;
    }

	public function getRows($page, $params = array())
    {
        $page = $page <= 0 ? 1 : $page;
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $orm = $this->_getOrmName();
        $sql = new $orm;
        $sql = $this->_filter($sql, $params);
        $result = $sql->orderBy('id', 'desc')
            ->take($limit)
            ->skip($offset)
            ->get();
        return $result;
    }

    public function getAll($params = array())
    {
        $orm = $this->_getOrmName();
        $sql = new $orm;
        $sql = $this->_filter($sql, $params);
        $result = $sql->orderBy('id', 'desc')->get();
        return $result;
    }

    public function update($id, $params = array())
    {
        $row = $this->getRow(intval($id));
        foreach ($params as $field => $val) {
            $row->$field = $val;
        }
        $row->save();
        return $row;
    }

	public function insert($params = array())
    {
        $orm = $this->_getOrmName();
        $model = new $orm;
        foreach ($params as $field => $val) {
            $model->$field = $val;
        }
        $model->save();
        return $model;
    }
}

