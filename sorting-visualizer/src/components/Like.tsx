
import { FaRegHeart } from "react-icons/fa";
import { FaHeart } from "react-icons/fa6";
import { useState } from "react";


interface Props{
  onClick: () => void;
}


const Like = ({ onClick }: Props) => {

  const [status, setStatus] = useState(false);

  const toggle = () => {
    setStatus(!status);
    onClick();
  };

  if(status) return <FaHeart size="200" color="red" onClick={toggle}/>
  else return (<FaRegHeart size="200" onClick={toggle}/>)


}

export default Like